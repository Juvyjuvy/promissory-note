<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function showregisterForm()
    {
        return view('register'); // Assumes you have a login.blade.php in resources/views
    }

    
}
