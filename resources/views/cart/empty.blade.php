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
        {{-- <tr>
            <td class="product-name">{{ $cartItem['name'] }}</td>
            <td class="product-price">€{{ $cartItem['ring_price'] }}</td>
            <td class="product-quantity">{{ $cartItem['quantity'] }}</td>
            <td>€{{ $cartItem['price'] }}</td>
            <td>Delete</td>
        </tr> --}}
      </tbody>
    </table>
    <div class="cart-total">
      <span class="cart-total-label">Total:</span>
      <span>€ 0</span>
    </div>
    <div class="checkout-btn">
      <button type="button" class="btn btn-primary">Proceed to Checkout</button>
    </div>
  </div>
@endsection

@section('scripts')
<script>
    console.log('Page specific script code goes here');
       
</script>
@endsection

