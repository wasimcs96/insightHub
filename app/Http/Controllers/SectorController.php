<?php

namespace App\Http\Controllers;

use App\Models\FlagQuestionsCombination;
use App\Models\Job;
use App\Models\MasterEducationLevel;
use App\Models\MasterSector;
use App\Models\QuizDomainValueAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use App\Exports\DataExport;
use App\Exports\EmployeeExport;
use App\Models\MasterCity;
use App\Models\Position;
use Maatwebsite\Excel\Facades\Excel;

class SectorController extends Controller
{
    function sectorUsers($id, Request $request)
    {
        $users = User::query();

        $users = $users->where('sector_id', $id);

        if ($request->has('gender') && $request->gender != '') {
            $users = $users->where('gender', '=', $request->gender);
        }

        if ($request->has('age') && $request->age != '') {
            $ageRange = $request->age;
            list(
                $minAge, $maxAge
            ) = explode('_', $ageRange);
            // Use Eloquent to filter users within the age range

            $users = $users->whereBetween('age', [$minAge, $maxAge]);
        }

        if ($request->has('education_level') && $request->education_level != '') {
            $users = $users->where('education_level', '=', $request->education_level);
        }


        if ($request->has('work_experience') && $request->work_experience != '') {
            $work_experienceRange = $request->work_experience;
            list(
                $minAge, $maxAge
            ) = explode('_', $work_experienceRange);
            // Use Eloquent to filter users within the age range

            $users = $users->whereBetween('year_of_experience_in_it_sector', [$minAge, $maxAge]);
        }


        $sector = MasterSector::find($id);

        $educationLevel = MasterEducationLevel::all();

        if ($request->has('action') && $request->action == "export") {

            $headings = [
                'First Name',
                'Last Name',
                'Email',
                'Age'
            ];
            $columns = ['first_name', 'last_name', 'email', 'age'];

            return Excel::download(new DataExport($users, $headings, $columns), 'users.xlsx');
        } else {

            $users = $users->paginate(10);

            return view('admin.sector', compact('users', 'sector', 'educationLevel'));
        }
    }

    function cityUsers($name, Request $request)
    {
        $users = User::query();

        if ($name == 'Other') {
            $users = $users->where('city', null);
        } else {
            $users = $users->where('city', $name);
        }



        if ($request->has('gender') && $request->gender != '') {
            $users = $users->where('gender', '=', $request->gender);
        }

        if ($request->has('age') && $request->age != '') {
            $ageRange = $request->age;
            list(
                $minAge, $maxAge
            ) = explode('_', $ageRange);
            // Use Eloquent to filter users within the age range

            $users = $users->whereBetween('age', [$minAge, $maxAge]);
        }

        if ($request->has('education_level') && $request->education_level != '') {
            $users = $users->where('education_level', '=', $request->education_level);
        }


        if ($request->has('work_experience') && $request->work_experience != '') {
            $work_experienceRange = $request->work_experience;
            list(
                $minAge, $maxAge
            ) = explode('_', $work_experienceRange);
            // Use Eloquent to filter users within the age range

            $users = $users->whereBetween('year_of_experience_in_it_sector', [$minAge, $maxAge]);
        }


        $city = MasterCity::where('name', $name)->first();

        $educationLevel = MasterEducationLevel::all();

        if ($request->has('action') && $request->action == "export") {

            $headings = [
                'First Name',
                'Last Name',
                'Email',
                'Age',
                'Phone',
                'National ID',
                'Passport No',
                'Passport Expiry Date',
                'Home Address',
                'Education Level',
                'Learning Institution',
                'Scope Of Study',
                'Work Experience In IT Sector'
            ];
            $columns = ['first_name', 'last_name', 'email', 'age', 'mobile_number'];

            return Excel::download(new EmployeeExport($users, $headings, $columns), 'users.xlsx');
        } else {

            $users = $users->paginate(10);

            return view('admin.city', compact('users', 'city', 'educationLevel'));
        }
    }


    function cityByPositions($level, Request $request)
    {
        $postionsArray = [1 => 1, 2 => 2, 3 => 3, 4 => 4];



        if (!in_array($level, $postionsArray)) {
            $level = 1;
        }

        $users = User::query();

        $positions = Job::where('level', $postionsArray[$level])->pluck('id')->toArray();

        $users = $users->where('company_id', auth()->user()->id)->where('role_id', 1)->whereIn('position_id', $positions);

        if ($request->has('gender') && $request->gender != '') {
            $users = $users->where('gender', '=', $request->gender);
        }

        if ($request->has('age') && $request->age != '') {
            $ageRange = $request->age;
            list(
                $minAge, $maxAge
            ) = explode('_', $ageRange);
            // Use Eloquent to filter users within the age range

            $users = $users->whereBetween('age', [$minAge, $maxAge]);
        }

        if ($request->has('education_level') && $request->education_level != '') {
            $users = $users->where('education_level', '=', $request->education_level);
        }


        if ($request->has('work_experience') && $request->work_experience != '') {
            $work_experienceRange = $request->work_experience;
            list(
                $minAge, $maxAge
            ) = explode('_', $work_experienceRange);
            // Use Eloquent to filter users within the age range

            $users = $users->whereBetween('year_of_experience_in_it_sector', [$minAge, $maxAge]);
        }

        $educationLevel = MasterEducationLevel::all();

        $levelOfPosition = $postionsArray[$level];

        if ($request->has('action') && $request->action == "export") {

            $headings = [
                'First Name',
                'Last Name',
                'Email',
                'Age',
                'Phone',
                'National ID',
                'Passport No',
                'Passport Expiry Date',
                'Home Address',
                'Education Level',
                'Learning Institution',
                'Scope Of Study',
                'Work Experience In IT Sector'
            ];
            $columns = ['first_name', 'last_name', 'email', 'age', 'mobile_number'];

            return Excel::download(new EmployeeExport($users, $headings, $columns), 'users.xlsx');
        } else {

            $users = $users->paginate(10);

            return view('admin.position', compact('users', 'positions', 'educationLevel', 'level', 'levelOfPosition'));
        }
    }
}
