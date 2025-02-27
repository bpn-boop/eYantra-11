<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerificationMail;
use Illuminate\Support\Facades\Crypt;
use App\Models\EmailVerificationToken;

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

            // send email
            $token = Hash::make($validated['email']);

            $validated['token'] = $token;
            $validated['expires_at'] = now()->addMinutes(30);
            EmailVerificationToken::create($validated);

            Mail::to($validated['email'])->send(new SendVerificationMail($validated, $token));

            return redirect('/verify-email');
            
            // User::create([
            //     'name' => $validated['name'],
            //     'email' => $validated['email'],
            //     'phone' => $validated['phone'],
            //     'password' => bcrypt($validated['password']),
            //     'role' => 'user'
            // ]);
    
            // return redirect('/')->with('success', 'User registered successfully');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function emailVerification($token, $user){
        try {
            // dcrypt user
            $decoded = sodium_base642bin($user, SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING);
            $decryptedUser = Crypt::decrypt($decoded);

            // decrypt token
            $decodedToken = sodium_base642bin($token, SODIUM_BASE64_VARIANT_URLSAFE_NO_PADDING);
            // $decryptedToken = Crypt::decrypt($decodedToken);

            $decryptedUser['password'] = bcrypt($decryptedUser['password']);
    // dd($decryptedUser, $decodedToken);
            //check if token exists and is valid
            $validatedToken = EmailVerificationToken::where('token', $decodedToken)->where('email', $decryptedUser['email'])->first();

            if (!$validatedToken) {
                return redirect('/')->with('failed', 'Invalid token');
            } else if ($validatedToken->expires_at < now()) {
                return redirect('/')->with('failed', 'Token expired');
            }
    
            User::create($decryptedUser);
    
            return redirect('/')->with('success', 'User registered successfully');
        } catch (\Exception $e) {
            return redirect('/')->with('failed', $e->getMessage());
        }
    }
}
