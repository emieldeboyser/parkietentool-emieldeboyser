<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    // show the view of the main page but only if the user is logged in
    public function index()
    {
        // show the view of the main page but only if the user is logged in
        if (auth()->check()) {
            return view('welcome');
        } else {
            // if the user is not logged in, redirect to the login page and show the view of the login page
            return view('authentication.index');
        }
    }

}
