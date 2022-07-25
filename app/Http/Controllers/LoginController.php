<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Requests\LoginRequest;
class LoginController extends Controller
{
    

    public function index()
    {
        # code...
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('Auth.login');
    }


    public function login(LoginRequest $request)
    {

        $validated = $request->validated();
        
        if(!$validated){
            return redirect()->back()->withErrors($request);
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if(Auth::check()){
            return redirect()->route('dashboard');
        }else{
            Session::flash('error','Email atau password salah');
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
