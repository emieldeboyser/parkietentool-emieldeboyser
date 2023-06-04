<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\Ring;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class OrderController extends Controller
{
    // show order view
    public function index()
    {
        // if the user is not logged in, redirect to the login page and show the view of the login page
        if (!auth()->check()) {
            return view('authentication.index');
        } else {
            // if the user is logged in, show the view of the order page
            $ringsVerhard = Ring::where('type_id', 1)->get();
            $ringsRvs = Ring::where('type_id', 2)->get();
            return view('order.index', compact('ringsVerhard','ringsRvs'));
        }
    }
}
