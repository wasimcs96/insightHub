<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AddEmployeeCodesToExistingUsers extends Seeder
{
    public function run()
    {
        // Get the current max value of employee_code's first part, e.g., "EMP-0001"
        $lastEmployeeCode = User::max('employee_code');
        
        // If there's no employee code yet, we start with EMP-0001
        $counter = $lastEmployeeCode ? intval(substr($lastEmployeeCode, 4, 4)) + 1 : 1;
        
        // Get the starting number for the second part, e.g., 1001
        $startingNumber = 1001;
        
        // Loop through all users that don't have an employee code
        User::where('id','>',1)->each(function ($user) use ($counter, $startingNumber) {
            // Generate the employee code in the format EMP-0001-1001
            $employeeCode = 'EMP-' . str_pad($counter, 4, '0', STR_PAD_LEFT) . '-' . str_pad($startingNumber, 4, '0', STR_PAD_LEFT);

            // Check if the generated employee code is already in use
            while (User::where('employee_code', $employeeCode)->exists()) {
                // If it exists, increment and generate again
                $counter++;
                $startingNumber++;
                $employeeCode = 'EMP-' . str_pad($counter, 4, '0', STR_PAD_LEFT) . '-' . str_pad($startingNumber, 4, '0', STR_PAD_LEFT);
            }
            
            // Assign and save the generated employee code
            $user->employee_code = $employeeCode;
            $user->save();

            // Increment both parts of the employee code for the next user
            $counter++;
            $startingNumber++;
        });
    }
}