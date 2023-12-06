<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails())
        {
            return redirect('/register')->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->save();

        return redirect('/');
    }

    // login
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        
        if(Auth::attempt($credentials))
        {
            return redirect('/dashboard');
        }
        else
        {
            return redirect('/')->withErrors(['error' => 'Invalid Credentials'])->withInput();
        }
    }

    // logout
    public function logout()
    {
            Auth::logout();
            session()->flush();
            return redirect('/');
    }
}
