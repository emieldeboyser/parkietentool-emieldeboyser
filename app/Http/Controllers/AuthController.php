<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    // show the view of login
    public function index()
    {
        return view('authentication.index');
    }
    // log user in 
    public function login(Request $request)
    {
        // validate the user input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // check if the user exists in the database if not redirect to the login page
        $user = User::where('email', $request->email)->first();
        // dd($user);


        // if the user exists, log the user in and redirect to the order page
        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect('/order');
            print_r("test");
        } else {
            return view('authentication.index');
        }


    }
    public function logout()
    {
        // logout the user
        auth()->logout();
        // redirect to the login page
        return view('welcome');
    }
}
