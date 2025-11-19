<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Http;
use App\Models\JobOpening;
use App\Models\Department;
use App\Models\MasterCity;

class HomeController extends Controller
{
    public function index()
    {
       if(auth()->check()){

        if(auth()->user()->isAdmin()){
            // return redirect('/admin/dashboard');
            return redirect('/insighthub');

        }elseif(auth()->user()->isEmployee()){
            
            return redirect('/dashboard');
        }

       }else {

        if (config('client.' . env('APP_BRANCH'))) {
            return redirect()->route('login');
        }
            return redirect()->route('login');


       }
        $query = JobOpening::where('status', 2)->take(4)->get();

            return view('avenger.frontend.home', ['jobApiData' => $query]);
       
    }

    public function getDepartment(){

        try{

            $department =  Department::where('status',1)->get();

             return response()->json([
                'status' => 'success',
                'data' => $department
            ], 200);  // 200 OK response


        }  catch (\Exception $e) {
        // Handle any other unexpected errors
        return response()->json([
            'status' => 'error',
            'message' => 'Internal Server Error'
        ], 500);  // 500 Internal Server Error response
    }
    }

    public function getCities(Request $request)
    {
      
        // Check if an ID is specified to fetch a specific barangay
        if ($request->has('id')) {
            $city = MasterCity::find($request->id);
            return response()->json([
                'id' => $city->id,
                'text' => $city->name
            ]);
        }

        // Handle search functionality
        $query = $request->get('q');
        $city = MasterCity::where('name', 'LIKE', "%{$query}%")->paginate(10);

        return response()->json([
            'results' => $city->map(function ($city) {
                return ['id' => $city->id, 'text' => $city->name];
            }),
            'pagination' => [
                'more' => $city->currentPage() < $city->lastPage()
            ]
        ]);
    }

}
