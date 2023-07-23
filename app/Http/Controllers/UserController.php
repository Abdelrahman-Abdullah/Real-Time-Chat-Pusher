<?php

namespace App\Http\Controllers;

use App\Events\PushMessage;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::select('name' , 'email' , 'id')
            ->where('id' , '!=' , auth()->id())
            ->get();
        return view('chat.index' , compact('users'));
    }

    public function chatForm($user_id){
        $user = User::select('name' , 'id')->where('id' , $user_id)->first();
        return view('chat.chat' , compact('user'));
    }

    public function sendMessage($user_id)
    {
        $user = User::select('name' , 'id')->where('id' , $user_id)->first();
        broadcast(new PushMessage($user , request()->message));
    }
}
