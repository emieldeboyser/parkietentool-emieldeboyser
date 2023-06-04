@extends("layouts/main")

@section("styles")
    @vite(['resources/css/cart.css'])
@endsection

@section('content')
    <div class="container">
        <h2>Your Cart</h2>
        <table class="table cart-table">
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $cartItem)
                <tr>
                    <td class="product-name">{{ $cartItem['name'] }}</td>
                    <td class="product-price">€{{ $cartItem['ring_price'] }}</td>
                    <td class="product-quantity">{{ $cartItem['quantity'] }}</td>
                    <td class="product-total">€{{ $cartItem['price'] }}</td>
                    <td><a href="{{ url('/cart/deleteItem', ['itemId' => $cartItem['id']]) }}"> Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form action="/cart/checkout" method="GET">
            @csrf
            {{-- remarks --}}
            <div class="form-group">
                <label for="customer-remarks">Opmerkingen:</label>
                <textarea class="form-control" id="customer-remarks" name="customerRemarks" rows="4"></textarea>
            </div>

            {{-- payment --}}
            <div class="form-group">
                <label for="payment_method">Betaling<span class="text-danger">*</span></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="online_payment" value="online_payment" required>
                    <label class="form-check-label" for="online_payment">
                        Online betalen
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="offline_payment" value="cash_payment">
                    <label class="form-check-label" for="cash_payment">
                        Cash betalen
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="offline_payment" value="overschrijving_payment">
                    <label class="form-check-label" for="offline_payment">
                        Overscrhijving
                </label>
                </div>
            </div>


            {{-- shipping --}}
            <div class="form-group">
                <label for="shipping-option">Verzending<span class="text-danger">*</span></label>
                @foreach ($shippings as $shipping)
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="shipping-option" id="standard-shipping" value="{{$shipping->price}}" required>
                    <label class="form-check-label" for="standard-shipping">{{$shipping->description}}, €{{$shipping->price}}</label>
                </div>
                @endforeach
            </div>

            {{-- address --}}
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="street">Street:</label>
                    <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="{{ $userAddress }}" required>
                </div>
                <div class="form-group col-md-2">
                    <label for="state">Number:</label>
                    <input type="number" class="form-control" id="state" name="number" placeholder="Number" value="{{ $userAddressNumber }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ $userAddressCity }}" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="zip">Postal Code:</label>
                    <input type="number" min="1000" max="9999" class="form-control" id="zip" name="zip" placeholder="Postal Code" value="{{ $userAddressPostalcode }}" required>
                </div>
            </div>


            <div class="checkout-btn">
                <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
            </div>
        </form>

        {{-- total of order --}}
        <div class="cart-total">
            <span class="cart-total-label">Total:</span>
            <span>€ 0</span>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    function countTotal() {
        const selectedShipping = document.querySelector('input[name="shipping-option"]:checked');
        let shippingcost = 0;

        if (selectedShipping) {
            shippingcost = parseFloat(selectedShipping.value);
        }

        const total = document.getElementsByClassName('product-total');
        let totalAmount = 0;

        for (let i = 0; i < total.length; i++) {
            totalAmount += parseFloat(total[i].innerText.replace('€', ''));
        }

        const cartTotalElement = document.querySelector('.cart-total span:last-child');
        const cartTotal = totalAmount + shippingcost;

        cartTotalElement.innerText = `€${totalAmount.toFixed(2)} + €${shippingcost.toFixed(2)} = €${cartTotal.toFixed(2)}`;
        }

        // Add event listener to radio buttons
        const shippingOptions = document.querySelectorAll('input[name="shipping-option"]');
        shippingOptions.forEach(function (option) {
        option.addEventListener('change', countTotal);
    });

    // Initial calculation
    countTotal();

       
</script>
@endsection

