<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Subscription;
use DateTime;

class UserController extends Controller
{
    // show the profile of the user
    public function index()
    {
        if (!auth()->check()) {
            return view('authentication.index');
            $orders = Order::where('user_id', Auth::user()->id)->get();
            dd($orders);
        } else {
            $today = new DateTime();
            if (!auth()->check()) {
                return view('authentication.index');
            }

            $user = Auth::user();
            $subscription = Subscription::where('user_id', $user->id)->first();

            $subscriptionData = null;
            if ($subscription) {
                $subscriptionData = [
                    'membership_paid' => $subscription->membership_paid,
                    'membership_end' => date('d-m-Y', strtotime($subscription->membership_end)),
                    'membership_started' => date('d-m-Y', strtotime($subscription->membership_started)),
                    'created_at' => date('d-m-Y', strtotime($subscription->created_at)),
                ];
            }

            return view('profile/index', compact('user', 'subscriptionData', 'today'));
        }
    }
}
