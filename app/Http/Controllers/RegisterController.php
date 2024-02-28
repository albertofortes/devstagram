<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index () 
    {
        return view('auth.register');
    }

    public function store (Request $request) 
    {
        //dd($request);
        //dd($request->get('username'));

        // Overrides
        $request->request->add(['username' => Str::slug($request->username)]);

        // Validations
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|min:3|max:30|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:4,255|confirmed',
            'password_confirmation' => 'required|same:password'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username, // override above
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Autheticate new user
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect()->route('posts.index', auth()->user()->username );
    }
}
