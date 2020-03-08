<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

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
        $users=User::orderBy('updated_at','DESC')->get();

        return view('users.index',compact('users'));
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
        $this->authorize('isAdmin');
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|same:confpass',
        ]);
        $user = new user;
        foreach($r as $request->role){
            $role = Role::where('name',$r);
            $user->roles()->attach($role->id);
        }
        if($request->hasfile('picture')&& $request->file('picture')->isValid()){
            $path=fileUpload($request->file('picture'),'users_img');
            $user->picture=$path;
        }
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
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
        $this->authorize('isAdmin');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $this->authorize('isAdmin');
        $user=User::findOrFail($id);
        if($user->picture)
           Storage::disk('public')->delete($user->picture);
        $user->delete();
        session()->flash('Message', 'user destroyed successfully');
        return redirect()->back();
    }
}
