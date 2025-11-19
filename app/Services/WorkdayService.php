<?php

namespace App\Services;

use App\Models\User;
use App\Models\AaUserDetail;
use App\Models\AaDetail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Services\AiApiService;
use Exception;

class WorkdayService
{
    protected $rassUrl;
    protected $serviceUrl;
    protected $username;
    protected $password;
    protected $aiApiService;
    
    public function __construct(AiApiService $aiApiService)
    {
        $this->rassUrl     = config('services.workday.rass_url');
        $this->serviceUrl  = config('services.workday.service_url');
        $this->username    = config('services.workday.username');
        $this->password    = config('services.workday.password');

        $this->aiApiService = $aiApiService;
    }

    /**
     * Download the employee CSV from Workday RaaS and store locally.
     *
     * @return string  Path to stored CSV
     * @throws Exception
     */
    public function downloadEmployeeCsv(): string
    {
        $response = Http::withBasicAuth($this->username, $this->password)
                        ->get($this->rassUrl);

        if (! $response->successful()) {
            throw new Exception('Failed to download CSV from Workday RaaS API.');
        }

        $path = 'workday/employee_data_' . now()->format('Y_m_d_His') . '.csv';
        Storage::put($path, $response->body());

        return $path;
    }

    /**
     * Parse a stored CSV file into an array of associative rows.
     *
     * @param  string  $filePath
     * @return array
     */
    public function parseCsv(string $filePath): array
    {
        $rows   = [];
        $handle = fopen(storage_path("app/{$filePath}"), 'r');
        $header = fgetcsv($handle);

        while ($data = fgetcsv($handle)) {
            $rows[] = array_combine($header, $data);
        }

        fclose($handle);

        return $rows;
    }

    /**
     * Insert new employees into DB, skip if email already exists.
     *
     * @param  array  $csvData
     * @return void
     * @throws Exception
     */
    public function storeEmployeeData(array $csvData): void
    {
        foreach ($csvData as $row) {
            $email = $row['email'];

            // skip if user already exists
            if (User::where('email', $email)->exists()) {
                continue;
            }

            DB::transaction(function () use ($row) {
                // 1) Create user
                $user = User::create([
                    'name'     => $row['name'],
                    'email'    => $row['email'],
                    'password' => bcrypt('TemporaryPassword123!'),
                ]);

                // 2) Create aa_user_details
                AaUserDetail::create([
                    'user_id'     => $user->id,
                    'employee_id' => $row['employee_id'],
                    'job_id'      => $row['job_id'],
                ]);

                // 3) Create aa_details (example additional field)
                AaDetail::create([
                    'user_id'          => $user->id,
                    'additional_field' => $row['additional_field'] ?? null,
                ]);
            });
        }
    }

    // Update Employee JD
    public function updateJobDescription($employeeId, $jobDescriptionData)
    {
        $payload = [
            'Employee_ID' => $employeeId,
            'Job_Description' => $jobDescriptionData,
        ];

        $response = Http::withBasicAuth($this->username, $this->password)
                        ->post($this->serviceUrl, $payload);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to update Job Description in Workday.');
    }


    public function getJobFamilyGroup()
    {
        return $this->aiApiService->get('/api/v0/jd-selector/sectors');
    }

    public function getJobFamilyByGroup(string $sector)
    {
        $params = ['sector' => $sector];
        return $this->aiApiService->get('/api/v0/jd-selector/tracks', $params);
    }

    public function getJobPositionByJobFamily(string $sector, string $track)
    {
        $params = ['sector' => $sector, 'track' => $track];
        return $this->aiApiService->get('/api/v0/jd-selector/roles', $params);
    }

    public function getPositionDetails(string $sector, string $track, string $role)
    {
        $params = ['sector' => $sector, 'track' => $track, 'role' => $role];
        return $this->aiApiService->get('/api/v0/jd-selector/role-details', $params);
    }
}


