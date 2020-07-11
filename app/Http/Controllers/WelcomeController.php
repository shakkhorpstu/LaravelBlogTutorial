<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $name = "Mahmud";
        $email = "mahmudshakkhor@gmail.com";
        return view('welcome', compact('name', 'email'));
    }

    public function test()
    {
        return view('test');
    }
}
