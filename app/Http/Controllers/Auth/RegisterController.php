<?php

// app/Http/Controllers/Auth/RegisterController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname'          => ['required','string','max:255'],
            'email'             => ['required','email','max:255','unique:users,email'],
            'course'            => ['required','string','max:255'],
            'year_level'        => ['required','in:1,2,3,4'],
            'college'           => ['required','string','max:255'],
            'gender'            => ['required','string','max:50'],
            'password'          => ['required','confirmed','min:8'],
        ]);

        $user = User::create([
            'fullname'          => $validated['fullname'],
            'email'             => $validated['email'],
            'password'          => Hash::make($validated['password']),
            'role'              => 'student',     // default role
            'course'            => $validated['course'],
            'year_level'        => $validated['year_level'],
            'college'           => $validated['college'],
            'gender'            => $validated['gender'],
            'submission_count'  => 0,             // initialize counter
        ]);

        Auth::login($user);

        return redirect()->route('student.dashboard')
            ->with('success', 'Account created successfully. Welcome!');
    }
}
