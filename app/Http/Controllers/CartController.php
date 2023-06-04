<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ring;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Shipping;
// use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Str;
// use Laravel\Cashier\Billable;



class CartController extends Controller
{
    public function index()
    {
        // get shipping details from db
        // get all shipping details from db
        $shippings = Shipping::all();

        // show the view of the cart page
        $cartItems = session()->get('cart');

        // get user adress from db
        $user = auth()->user();
        $userInfo = User::where('id', $user->id)->first();
        // dd($userInfo);
        // get user address_street from db
        $userAddress = $userInfo->address_street;
        // get user address_number from db
        $userAddressNumber = $userInfo->address_nr;
        // get user address_city from db
        $userAddressCity = $userInfo->address_city;
        // get user address_postalcode from db
        $userAddressPostalcode = $userInfo->address_zipcode;


        if (!$cartItems) {
            return view('cart.empty');
        }
        // dd($cartItems);

        return view('cart.index', compact('shippings', 'cartItems', 'userAddress', 'userAddressNumber', 'userAddressCity', 'userAddressPostalcode'));
    }

    public function add(Request $request)
    {
        // $request->session()->flush();

        // add a ring to the cart
        $ringId = $request->input("button_id");
        $amount = $request->input($ringId);

        $ring = Ring::find($ringId);

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if (!$cart) {
            $cart = [
                $ringId => [
                    "name" => $ring->name,
                    "size" => $ring->size,
                    "quantity" => $amount,
                    "ring_price" => $ring->price,
                    "price" => $ring->price * $amount,
                    "id" => $ring->id,
                ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if cart not empty then check if this product exist then increment quantity
        if (isset($cart[$ringId])) {
            $cart[$ringId]['quantity'] = $cart[$ringId]['quantity'] + $amount;
            $cart[$ringId]['price'] = $cart[$ringId]['quantity'] + $amount * $ring->price;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }

        // if item not exist in cart then add to cart without deleting existing data
        $cart[$ringId] = [
            "name" => $ring->name,
            "size" => $ring->size,
            "quantity" => $amount,
            "ring_price" => $ring->price,
            "price" => $ring->price * $amount,
            "id" => $ring->id,
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');


        // return view('welcome');
    }

    public function deleteItem($itemId)
    {
        // delete a ring from the cart

        $cartItems = session()->get('cart');

        if (isset($cartItems[$itemId])) {
            unset($cartItems[$itemId]);
            session()->put('cart', $cartItems);
        }

        return redirect()->back();
    }
}
