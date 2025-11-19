<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserPerformanceRating;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserPerformanceRatingImport;

class UserPerformanceRatingImport implements ToCollection, WithHeadingRow
{
    protected $users;

    public function __construct()
    {
        // Load all users at once to avoid querying per row
        $this->users = User::selectRaw('LOWER(email) as email, id')->pluck('id', 'email');
    }

    public function collection(Collection $rows)
    {
        $data = [];
       
        foreach ($rows as $row) {
            $email = strtolower(trim($row['email'] ?? ''));

            if (!isset($this->users[$email])) {
                Log::warning("User not found for email: " . $email);
                continue;
            }
            
            $userId = $this->users[$email];

            foreach ([2021, 2022, 2023,2024] as $year) {
                $ratingColumn = "{$year}_rating_numerical";
                $descriptorColumn = "{$year}_rating_descriptor";
                
                if (!isset($row[$ratingColumn])) {
                    Log::warning("Missing rating for year {$year} in row: " . json_encode($row));
                    continue;
                }

                $rating = is_numeric($row[$ratingColumn]) ? $row[$ratingColumn] : 0.00;
                $descriptor = $row[$descriptorColumn] ?? null;
                $description = $row['remarks'] ?? null;

                if ($rating == 0.00) {
                    $normalized_rating = 0;
                } elseif ($rating > 0 && $rating < 2) {
                    $normalized_rating = 1;
                } elseif ($rating > 3) {
                    $normalized_rating = 3;
                } else {
                    $normalized_rating = 2;
                }

                // Check if the record exists for the same user_id and year
                $existingRecord = UserPerformanceRating::where('user_id', $userId)
                    ->where('year', $year)
                    ->first();

                if ($existingRecord) {
                    // Update existing record
                    $existingRecord->update([
                        'rating'             => $rating,
                        'normalized_rating'  => $normalized_rating,
                        'rating_descriptor'  => $descriptor,
                        'rating_description' => $description,
                    ]);
                } else {
                    // Insert new record
                    $data[] = [
                        'user_id'            => $userId,
                        'year'               => $year,
                        'rating'             => $rating,
                        'normalized_rating'  => $normalized_rating,
                        'rating_descriptor'  => $descriptor,
                        'rating_description' => $description,
                        'created_at'         => now(),
                        'updated_at'         => now(),
                    ];
                }
            }
        }
        // dd($data[5], $rows[1]);
        // Bulk insert new records for better performance
        if (!empty($data)) {
            UserPerformanceRating::insert($data);
        }
    }
}
