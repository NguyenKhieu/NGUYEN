<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;

class UserController  extends Controller
{

    public function GetloginAdmin() {
        return view('admin.login');
    }
    public function PostloginAdmin(Request $request) {
        $rules = [
            'email' =>'required|email',
            'password' => 'required|min:8'
        ];
        $messages = [
            'email.required' => 'Email is required',
            'email.email' => 'Email invalidate',
            'password.required' => 'Pass is required',
            'password.min' => 'Pass min - 8 characters',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $email = $request->input('email');
            $password = $request->input('password');

            if( Auth::attempt(['email' => $email, 'password' =>$password])) {
                return redirect()->route('category.store');
            } else {
                $errors = new MessageBag(['errorlogin' => 'Email or Pass incorrect']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        }
    }
    public function GetlogoutAdmin(){
        return redirect()->route('getlogin')->with(Auth::logout());
    }
}