<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mollie\Laravel\Facades\Mollie;
use App\Models\Order;
use App\Models\Subscription;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        if (!$request->has('id')) {
            Log::alert('No ID');
            return;
        }

        $payment = Mollie::api()->payments()->get($request->id);

        if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {

            $orderId = $payment->metadata->order_id;
            Log::alert($orderId);
            $order = Order::where('reference', $orderId)->first();

            $order->payment_data = "Paid";
            $order->save();

            Log::alert('Order status updated');
        } elseif ($payment->isOpen()) {
            /*
            * The payment is open.
            */
        } elseif ($payment->isPending()) {
            /*
            * The payment is pending.
            */
        } elseif ($payment->isFailed()) {
            /*
            * The payment has failed.
            */
        } elseif ($payment->isExpired()) {
            /*
            * The payment is expired.
            */
        } elseif ($payment->isCanceled()) {
            /*
            * The payment has been canceled.
            */
        } elseif ($payment->hasRefunds()) {
            /*
            * The payment has been (partially) refunded.
            * The status of the payment is still "paid"
            */
        } elseif ($payment->hasChargebacks()) {
            /*
            * The payment has been (partially) charged back.
            * The status of the payment is still "paid"
            */
        }
    }
    public function handleSubscription(Request $request)
    {
        Log::alert('Subscription webhook called');
        if (!$request->has('id')) {
            Log::alert('No ID');
            return;
        }

        $payment = Mollie::api()->payments()->get($request->id);

        if ($payment->isPaid() && !$payment->hasRefunds() && !$payment->hasChargebacks()) {
            $orderId = $payment->metadata->user_id;
            Log::alert($orderId);

            $order = Subscription::where('user_id', $orderId)->first();
            Log::alert($order);

            if ($order) {
                $order->membership_paid = "Betaald";
                $order->membership_started = date('Y-m-d');
                $order->membership_end = date('Y-m-d', strtotime('+1 year'));
                $order->save();

                Log::alert('Order status updated');
            } else {
                Log::alert('Order not found');
            }
        } elseif ($payment->isOpen()) {
            /*
         * The payment is open.
         */
        } elseif ($payment->isPending()) {
            /*
         * The payment is pending.
         */
        } elseif ($payment->isFailed()) {
            /*
         * The payment has failed.
         */
        } elseif ($payment->isExpired()) {
            /*
         * The payment is expired.
         */
        } elseif ($payment->isCanceled()) {
            /*
         * The payment has been canceled.
         */
        } elseif ($payment->hasRefunds()) {
            /*
         * The payment has been (partially) refunded.
         * The status of the payment is still "paid".
         */
        } elseif ($payment->hasChargebacks()) {
            /*
         * The payment has been (partially) charged back.
         * The status of the payment is still "paid".
         */
        }
    }
}
