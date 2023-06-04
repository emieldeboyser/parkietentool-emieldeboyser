<?php

namespace App\Http\Controllers;

use Mollie\Laravel\Facades\Mollie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use App\Models\Order;
use App\Models\OrderItem;

class CheckOutController extends Controller
{
    public function cashIndex()
    {
        $user_Name = auth()->user()->name;

        // order number of last order from user
        $order = Order::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->first();
        $orderNumber = $order->reference;
        $orderTotal = $order->total_price;

        return view('order.cash', compact('user_Name', 'orderNumber', 'orderTotal'));
    }

    public function bankIndex()
    {
        $user_Name = auth()->user()->name;

        // order number of last order from user
        $order = Order::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->first();
        $orderNumber = $order->reference;
        $orderTotal = $order->total_price;

        return view('order.bank', compact('user_Name', 'orderNumber', 'orderTotal'));
    }
    public function checkout(Request $request)
    {
        // Retrieve all data from the form
        $shippingCost = $request->input('shipping-option');
        $paymentMethod = $request->input('payment_method');
        $remarks = $request->input('customerRemarks');
        $address = $request->input('street');
        $number = $request->input('number');
        $city = $request->input('city');

        // Get all cart items from session storage
        $cartItems = session()->get('cart');

        $total = [];
        $ringsArray = [];
        $ringsCodeArray = [];
        $totalPrice = 0;


        foreach ($cartItems as $item) {
            $totalPrice += $item['price'];
            $total[] = $item['price'];
            $ringsArray[] = $item['id'];
            $ringsCodeArray[] = $item['name'];
        }

        // Generate a random reference for the order
        $randomString = $this->generateRandomString(10);

        // Check if the order ID exists in the database
        $order = Order::where('reference', $randomString)->first();
        if ($order) {
            $randomString = $this->generateRandomString(10);
        }

        // Add the user ID to the beginning of the random string
        $randomString = auth()->user()->id . $randomString;

        // Serialize the ring IDs and codes and amounts
        $ringsIds = implode(",", $ringsArray);
        $ringsCodes = implode(",", $ringsCodeArray);
        $SerializeTotal = implode(",", $total);
        // Create and save the order item
        $orderItem = new OrderItem([
            'ring_id' => serialize($ringsIds),
            'order_id' => $randomString,
            'amounts' => serialize($SerializeTotal),
            'total_price' => $totalPrice,
            'ring_codes' => serialize($ringsCodes),
            'completed' => "Nieuwe bestelling",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $orderItem->save();

        // Add address to shipping data with the shipping type
        $address = $address . " " . $number . " " . $city . "Shippingmethod:" . "€" . $shippingCost;

        if ($paymentMethod == 'cash_payment') {
            // Create and save the order
            $order = new Order([
                'user_id' => auth()->user()->id,
                'reference' => $randomString,
                'payment_data' => "cash",
                'total_price' => $totalPrice,
                'shipping_data' => $address,
                'remarks' => $remarks,
                "status" => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $order->save();
            return redirect()->route('checkout.succes.cash');
        } elseif ($paymentMethod == 'overschrijving_payment') {
            // Create and save the order
            $order = new Order([
                'user_id' => auth()->user()->id,
                'reference' => $randomString,
                'payment_data' => "overschrijving",
                'total_price' => $totalPrice,
                'shipping_data' => $address,
                'remarks' => $remarks,
                "status" => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $order->save();
            return redirect()->route('checkout.succes.bank');
        } else {
            // Create and save the order
            $order = new Order([
                'user_id' => auth()->user()->id,
                'reference' => $randomString,
                'payment_data' => "not paid yet",
                'total_price' => $totalPrice,
                'shipping_data' => $address,
                'remarks' => $remarks,
                "status" => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $order->save();

            $webhookUrl = App::environment('local')
                ? 'https://87f2-78-22-120-25.ngrok-free.app/webhooks/mollie'
                : route('webhooks.mollie');

            Log::alert('CheckoutController');

            // Calculate the total amount of the order with shipping cost
            $totalPrice = $totalPrice + $shippingCost;

            // Format the total as a string with 2 decimals
            $totalPrice = number_format($totalPrice, 2);

            // Create a payment with Mollie
            $payment = Mollie::api()->payments()->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $totalPrice,
                ],
                "description" => "Bestelling op " . date('d-m-Y h:i'),
                "redirectUrl" => route('checkout.succes'),
                "webhookUrl" => $webhookUrl,
                "metadata" => [
                    "order_id" => $randomString,
                ],
            ]);

            return redirect($payment->getCheckoutUrl(), 303);
        }
    }

    public function succes()
    {
        session()->forget('cart');

        return view('order.succes');
    }

    private function generateRandomString($length)
    {
        $characters = '0123456789';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
}
