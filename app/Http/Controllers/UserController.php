<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    { 
        $users=User::orderBy('updated_at')->get();
        $roles=Role::all();
        return view('users.index',compact('users','roles'));
    }
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize('isAdmin');
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'picture'=>'file|image'
            ]);
        $user = new User;
        if(empty($request->roles))
             return redirect()->back();
       
       
        if($request->hasfile('picture')&& $request->file('picture')->isValid()){
            $path=fileUpload($request->file('picture'),'users_img');
            $user->picture=$path;
        }
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
       
        $user->save();
        foreach($request->roles as $r){
            $role = Role::where('name','=',$r)->get()->first();
            $user->roles()->attach($role->id);
        }
        session()->flash('Message', 'user created successfully');
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
        $user=User::findOrFail($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::findOrFail($id);
        return view('users.edit',compact('user'));
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
        $user=auth()->user();
        //$this->authorize('isAdmin');
        if(!empty($request->name)){
            $this->validate($request,[
                'name'=>'required'
            ]);
            $user->name=$request->name;
        }
        if(!empty($request->email)){
            $this->validate($request,[
                'email'=>'required|unique:users'
            ]);
            $user->email=$request->email;
        }
        if(!empty($request->passwd) && !empty($request->confpass)){
            if (Hash::check($request->passwd, $user->password)) 
                $user->password=$request->password;
            else{
                session()->flash('Message', 'Wrong password');
                return redirect()->back();
            }
        } 
        if(!empty($request->picture)){
            $path=unlinkAndUpload($request->file('picture'),$article->picture,'uesrs_img');
            $user->picture=$path;
        }         
        $user->save();
        session()->flash('Message', 'Profil updated successfully');

        
        return redirect()->back();
    }
    function getId($r){
        return $r->id;
    }
   public function grantRoles(Request $request,$id){
       $user=User::findOrFail($id);
       $user->roles()->detach();
       $a=array();
        foreach($request->roles as $r){
            $role = Role::where('name','=',$r)->get()->first();
            array_push($a,$role->id);
        }
        $user->roles()->toggle($a);
        session()->flash('Message', 'Role granted to member '.$user->name.' successfully');
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
       // $this->authorize('isAdmin');
        $user=User::findOrFail($id);
        if($user->picture)
           Storage::disk('public')->delete($user->picture);
        $user->delete();
        session()->flash('Message', 'user destroyed successfully');
        return redirect()->back();
    }
}
