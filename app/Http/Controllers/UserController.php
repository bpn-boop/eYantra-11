<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function signup()
    {
        return view('auth.user.signup');
    }

    public function sotreSignup(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'min:2', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'regex:/^(98|97)\d{8}$/', 'unique:users'],
                'password' => ['required', 'string', 'confirmed', Password::defaults()],
            ]);
            
            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => bcrypt($validated['password']),
                'role' => 'user'
            ]);
    
            return redirect('/')->with('success', 'User registered successfully');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
