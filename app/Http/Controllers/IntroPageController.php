<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class IntroPageController extends Controller
{
    public function intropage()
    {
        return view('welcome'); // Assumes you have a login.blade.php in resources/views
        return view('welcome'); // Renders resources/views/welcome.blade.php
    }

    
}