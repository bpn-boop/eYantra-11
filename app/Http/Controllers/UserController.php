<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function signup()
    {
        return view('auth.user.signup');
    }

    public function sotreSignup(Request $request)
    {//dd($request->all());
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'confirmed'],
            ]);
    
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'role' => 'user'
            ]);
    
            return redirect('/')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('failed', $e->getMessage());
        }
    }
}
