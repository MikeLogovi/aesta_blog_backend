<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $departments=Department::orderBy('updated_at','DESC')->get();
        return view('departments.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->authorize('isAdmin');
        $this->validate($request,[
            'name'=>'required|unique:departments',
            'picture'=>'required|file|image'
        ]);
        $department = new Department;
        if($request->hasfile('picture')&& $request->file('picture')->isValid()){
            $path=fileUpload($request->file('picture'),'departments_img');
            $department->picture=$path;
        }
        $department->name=$request->name;
        $department->save();
        session()->flash('Message', 'Department created successfully');
        return redirect()->back();
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
        $department=Department::findOrFail($id);
        return view('departments.edit',compact('department'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {   
        $this->authorize('isAdmin');
        if(!empty($request->name)){
            $this->validate($request,[
                'name'=>'unique:departments'
            ]);
            $department->name=$request->name;    
        }
        if(!empty($request->picture)){
            $path=unlinkAndUpload($request->file('picture'),$department->picture,'departments_img');
            $department->picture=$path;
        }
        $department->save();
        session()->flash('Message', 'Departement updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $this->authorize('isAdmin');
        $department=Department::findOrFail($id);
        Storage::disk('public')->delete($department->picture);

        $department->delete();
        session()->flash('Message', 'Department destroyed successfully');
        return redirect()->back();
    }
}
