<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;



class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('asdf');
        $positions = Position::where('company_id',auth()->user()->id)->orderBy('created_at', 'desc')->get();

        $data = ['positions'=>$positions];

        return view('admin.position.lists',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $departments = Department::where('company_id',auth()->user()->id)->orderBy('created_at', 'DESC')
        ->get();

        $data = [
            'pageTitle' => 'Position Create',
            'departments' => $departments
        ];
        return view('admin.position.create',$data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'department' => 'required',
            'position_name' => 'required',
            'level' => 'required',
        ]);

        Position::create([
            'department_id'=> $request->department,
            'company_id'=>auth()->user()->id,
            'name'=> $request->position_name,
            'level'=>$request->level,
        ]);

        return redirect()->route('admin.position.index')
                         ->with('success','Position created successfully.');
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
        $departments = Department::where('company_id',auth()->user()->id)->orderBy('created_at', 'DESC')
        ->get();
        $position = Position::find($id);
        // dd($position);

        $data = [
            'pageTitle' => 'Position Edit',
            'position'=>$position,
            'departments' => $departments
        ];
        return view('admin.position.create',$data);
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
            'department' => 'required',
            'position_name' => 'required',
            'level' => 'required',
        ]);
        $position = Position::find($id);


        $position->update([
            'department_id'=>$request->department,
            'name'=>$request->position_name,
            'level'=>$request->level,

        ]);

        return redirect()->route('admin.position.index')
                         ->with('success','Position updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {

        $position = Position::find($id);

        $position->delete();

        return redirect()->route('admin.position.index')
                         ->with('success','Position deleted successfully');
    }
}
