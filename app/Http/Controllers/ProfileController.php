<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Replace "User" with your actual user model
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Support\Facades\App;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        // Validate and process the form data
        // Retrieve the user record based on the authenticated user or any identifier
        if (!auth()->check()) {
            return view('authentication.index');
        } else {
            $user = User::find(auth()->user()->id); // Example: retrieve user by authenticated user ID
            // Update the user record with the new values
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->stamnr = $request->input('stamnr');
            $user->email = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->address_street = $request->input('address_street');
            $user->address_nr = $request->input('address_nr');
            $user->address_zipcode = $request->input('address_zipcode');
            $user->address_city = $request->input('address_city');
            $user->phone = $request->input('phone');
            $user->birthday = $request->input('birthday');

            // Save the updated user record
            $user->save();

            // Redirect or perform any other actions
            return redirect('/profile')->with('success', 'Profile updated successfully.');
        }
    }
    public function updatePicture(Request $request)
    {
        // Validate and process the form data
        // Retrieve the user record based on the authenticated user or any identifier
        if (!auth()->check()) {
            return view('authentication.index');
        } else {
            $user = User::find(auth()->user()->id); // Example: retrieve user by authenticated user ID


            $location = Storage::disk('public')->put('users', $request->file('avatar'));

            // Update the user record with the new values
            $user->avatar = $location;

            // Save the updated user record
            $user->save();

            // Redirect or perform any other actions
            return redirect('/profile')->with('success', 'Profile updated successfully.');
        }
    }

    public function settings()
    {
        if (auth()->check()) {
            $user = User::find(auth()->user()->id);
            return view('profile/settings', compact('user'));
        } else {
            return view('authentication.index');
        }
    }

    public function orders()
    {
        if (auth()->check()) {
            $user = Auth::user()->id;
            $orders = Order::where('user_id', Auth::user()->id)->get();

            return view('profile/orders', compact('orders'));
        } else {
            return view('authentication.index');
        }
    }

    public function lidgeld()
    {
        if (auth()->check()) {
            $user = Auth::user();

            $subscription = Subscription::where('user_id', Auth::user()->id)->get();

            if (!$subscription == null) {
                // Create a new subscription
                $subscription = new Subscription();
                $subscription->user_id = $user->id;
                $subscription->created_at = now();
                $subscription->save();

                // get webhook url
                $webhookUrl = route('webhooks.mollie.subscription');
                if (App::environment('local')) {
                    $webhookUrl = 'https://83ca-78-22-120-25.ngrok-free.app/webhooks/subscription';
                }

                // price of subscription
                $total = 26;

                // make total a string with 2 decimals
                $total = number_format($total, 2);

                // get user id
                $user_id = Auth::user()->id;

                // create a payment with mollie
                $payment = Mollie::api()->payments()->create([
                    "amount" => [
                        "currency" => "EUR",
                        "value" => $total, // You must send the correct number of decimals, thus we enforce the use of strings
                    ],
                    "description" => "Bestelling op" . date('d-m-Y h:i'),
                    "redirectUrl" => route('profile.index'),
                    "webhookUrl" => $webhookUrl,
                    "metadata" => [
                        "user_id" => $user_id,
                        "lidgeld" => true,
                    ],
                ]);
                return redirect($payment->getCheckoutUrl(), 303);
            }
        } else {
            return view('authentication.index');
        }
    }
}
