<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResult extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Function to retrieve results by user_id
    public static function getFormattedResults($userId, $assessmentType = null, $resultType = null)
    {
         // Single DB call to get all results for the user
         $results = self::where('user_id', $userId)->get();
 
         // In-memory filtering based on assessment_type and result_type
         if ($assessmentType) {
             $results = $results->where('assessment_type', $assessmentType);
         }
 
         if ($resultType) {
             $results = $results->where('result_type', $resultType);
         }
 
         // Format results in the required structure
         $formattedResults = $results->mapWithKeys(function ($result) {
             return [
                 $result->slug => [
                     'name' => $result->name,
                     'assessment_type' => $result->assessment_type,
                     'result_type' => $result->result_type,
                     'score' => $result->score,
                     'z_score' => $result->z_score,
                     'percentage' => $result->percentage,
                     'level' => $result->level,
                     'level_description' => $result->level_description,
                     'description' => $result->description,
                 ],
             ];
         });
 
         return $formattedResults;
    }

}
