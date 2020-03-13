<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
class MessageController extends Controller
{
    public function index(){
        $this->authorize('isAuthorized');
        $messages=Message::all();
        $messagesNew=Message::where('read',false)->get();
        return view('messages.index',compact('messages','messagesNew'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'message'=>'required'
            ]
        );
        $message=New Message;
        $message->name=$request->name;
        $message->email=$request->email;
        $message->message=$request->message;
        $message->save();
        return $message;
    }
    public function destroy(Request $request){
        $message=Message::findOrFail($request->id);
        $message->delete();
        session()->flash('Message', 'Message deleted successfully');
        return redirect()->back();
    }
    public function makeRead(Request $request,$id){
        $message=Message::findOrFail($id);
        $message->read=true;
        $message->save();
        return ['good'];
    }
}
