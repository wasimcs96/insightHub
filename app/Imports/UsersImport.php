<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Hash;
use Auth;
class UsersImport implements ToModel, WithHeadingRow
{

    private $departId;

    public function __construct($departId)
    {
        $this->departId = $departId;
    }


    public function model(array $row)
    {

        if ($row['password']) {
            // Hash the password
            $hashedPassword = Hash::make($row['password']);
            // Update user's password
        }

        $user = auth()->user();

        if($user->isCompany() || $user->isAdmin()) {
            $companyid = $user->id;
        }else{
            $companyid = $user->company_id;

        }
        // Create a new user instance using the data from the Excel row
        return new User([
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'role_id'=>1,
            'role_name' =>'employee',
            'company_id'=>$companyid,
            'department_id'=>$this->departId,
            'password'=>$hashedPassword,
            'name'=> $row['first_name'] . ' '.$row['last_name']
            // Add more fields as needed
        ]);
    }
}
