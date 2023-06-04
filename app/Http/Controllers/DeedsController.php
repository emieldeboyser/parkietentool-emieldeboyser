<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Ring;
use App\Models\User;
// use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class DeedsController extends Controller
{
    public function index()
    {
        // only admin can acces this page
        if (auth()->user()->role_id == 1) {
            $orders = Order::orderBy('id', 'desc')->get();
            return view('deeds.index', compact('orders'));
        } else {
            return redirect()->route('welcome');
        }
    }

    public function show($reference)
    {
        // Retrieve the order based on the reference
        $order = Order::where('reference', $reference)->first();

        // Retrieve the order items based on the order reference
        $orderItems = OrderItem::where('order_id', $reference)->get();

        // Get the Name of the user
        $user_id = $order->user_id;
        $user = User::where('id', $user_id)->first();
        $user_Name = $user->name;
        $stamnummer = $user->stamnr;

        if (!$order) {
            // Handle the case where the order is not found
            abort(404);
        }

        // Get the ring codes for each order item
        $ringCodes = $orderItems->map(function ($item) {
            $unserializedRingIds = unserialize($item->ring_id);
            $ringIds = explode(',', $unserializedRingIds);
            return $ringIds;
        })->flatten();

        // Get the ring data based on the ring codes
        $ring = [];
        foreach ($ringCodes as $ringCode) {
            $ring[] = Ring::where('id', $ringCode)->first();
        }

        $amountArr = $orderItems->map(function ($item) {
            $unserializedAmounts = unserialize($item->amounts);
            $amountId = explode(',', $unserializedAmounts);
            return $amountId;
        })->flatten();


        $amount = [];




        // Pass the data to the view
        return view('deeds.show', compact('order', 'user_id', 'user_Name', 'stamnummer', 'orderItems', 'ringCodes', 'ring', 'amountArr', 'amount'));
    }



    public function createPDF($orderReference)
    {
        $order = Order::where('reference', $orderReference)->first();

        // Retrieve the order items based on the order reference
        $orderItems = OrderItem::where('order_id', $orderReference)->get();

        // Get the Name of the user
        $user_id = $order->user_id;
        $user = User::where('id', $user_id)->first();
        $user_Name = $user->name;
        $stamnummer = $user->stamnr;

        if (!$order) {
            // Handle the case where the order is not found
            abort(404);
        }

        // Get the ring codes for each order item
        $ringCodes = $orderItems->map(function ($item) {
            $unserializedRingIds = unserialize($item->ring_id);
            $ringIds = explode(',', $unserializedRingIds);
            return $ringIds;
        })->flatten();

        // Get the ring data based on the ring codes
        $ring = [];
        foreach ($ringCodes as $ringCode) {
            $ring[] = Ring::where('id', $ringCode)->first();
        }

        $amountArr = $orderItems->map(function ($item) {
            $unserializedAmounts = unserialize($item->amounts);
            $amountId = explode(',', $unserializedAmounts);
            return $amountId;
        })->flatten();


        $amount = [];


        // Generate the PDF
        $pdf = PDF::loadView('deeds.show', ['deed' => $order, 'ringCodes' => $ringCodes, 'user_id' => $user_id, 'user_Name' => $user_Name, 'stamnummer' => $stamnummer, 'orderItems' => $orderItems, 'ring' => $ring, 'amountArr' => $amountArr, 'amount' => $amount]);

        // Optionally, you can customize the PDF settings
        $pdf->setPaper('A4', 'portrait');

        // Return the PDF as a response or save it to a file
        return $pdf->stream('order.pdf');
    }
}
