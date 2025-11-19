<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\TeamEmployees;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isCompany() || auth()->user()->isAdmin()){
            $teams = Team::where('company_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();

        }elseif(auth()->user()->isDepartment()){
            $teams = Team::where('department_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();
        }

        $data = ['teams'=>$teams];


        return view('admin.teams.lists',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $departments =  Department::where('company_id',auth()->user()->id)->select('head_of_department', 'id')
        ->orderBy('created_at', 'DESC')
        ->get();



        $data = [
            'pageTitle' => 'Teams Create',
            'departments' => $departments
        ];
        return view('admin.teams.create',$data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'department' => 'required',
            // 'employee' => 'required',
        ]);

       $team =  Team::create([
            'department_id'=> $request->department,
            'name'=> $request->title,
            'level'=>$request->level,
            'company_id'=>auth()->user()->id,
        ]);

        // if($team){
        //     foreach($request->employee as $emp){

        //         TeamEmployees::create([
        //             'team_id'=>$team->id,
        //             'employee_id'=>$emp,
        //             ]);
        //     }

        // }

        return redirect()->route('admin.teams.index')
                         ->with('success','Team created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::where('company_id',auth()->user()->id)->select('head_of_department', 'id')
        ->orderBy('created_at', 'DESC')
        ->get();
        // dd($departments);
        $team = Team::find($id);
        // dd($position);

        $data = [
            'pageTitle' => 'Position Edit',
            'team'=>$team,
            'departments' => $departments
        ];
        return view('admin.teams.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'department' => 'required',
        ]);
        $position = Team::find($id);


        $position->update([
            'department_id'=>$request->department,
            'name'=>$request->title,
            // 'level'=>$request->level,

        ]);

        return redirect()->route('admin.teams.index')
                         ->with('success','Team updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $team = Team::find($id);
        $team->teamEmployees()->delete();


        $team->delete();

        return redirect()->route('admin.teams.index')
                         ->with('success','Team deleted successfully');
    }

    public function getEmployee($departId)
    {

        $positions = User::where('department_id', $departId)->pluck('name', 'id');
        // dd($positions);
        return response()->json($positions);
    }

}
