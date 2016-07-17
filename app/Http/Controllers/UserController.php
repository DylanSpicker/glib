<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{
    public function showProfile($id = 0)
    {
        if(empty($id)){
            $user = Auth::user();
        } else {
            $user = User::find($id);
        }

        if(empty($user)) return view('profile')->withError("No such user found... Sorry!");

       	$issues     = $user->issues()->paginate(10, ['*'], 'issues');

        $arguments  = $user->arguments()->paginate(10, ['*'], 'arguments');

        return view('profile', compact("user","issues", "arguments"));
    }
}
