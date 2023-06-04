@extends("layouts/main")

@section("styles")
    @vite(['resources/css/app.css'])
@endsection

@section('content')
  <div>
    <div class="container">
      <div class="row">
        <div class="col text-right">
          <a href="/cart" class="text-decoration-none">
            <span class="fa-stack fa-lg">
              <i class="fas fa-shopping-cart fa-stack-1x"></i>
              {{-- <span class="fa-stack-1x cart-badge">3</span> --}}
            </span>
            <span class="cart-text pull-right">Your Cart</span>
          </a>
        </div>
      </div>
    </div>
    <div class="container">
      <h1>Product List</h1>
      <p>Click on the shopping cart icon to add a product to your cart.</p>
      <h6><i class="fa-solid fa-cart-shopping addToCart"></i></h6>
      <form id="product-form" action="../cart" method="POST">
        @csrf
        <div>
         <h2>Verharde ringen:</h2>
          <p>Minimum 10 ringen vereist</p>
          <div class="row">
            @foreach ($ringsVerhard as $ringVerhard)
            <div class="col-md-3 mb-3">
              <div class="card product-tile" >
                <div class="card-body">
                  <h5 class="card-title">{{$ringVerhard->size}} mm</h5>
                  <p class="card-text">€{{$ringVerhard->price}}</p>
                  <div class="form-group">
                    <label for="product1-amount">Aantal</label>
                    <input type="number" class="form-control" id="product1-amount" name="{{$ringVerhard->id}}" min="10">
                  </div>
                  <div class="shoppingcart">
                    <button type="submit" name="button_id" value="{{$ringVerhard->id}}" class="btn btn-secondary"><i class="fa-solid fa-cart-shopping addToCart"></i></button>
                  </div>
                </div>
              </div>
              {{-- <p class="hidden error">Toegevoegd aan winkelmand!</p> --}}
            </div>
            
            @endforeach
          </div> 
        </div>

        <div>
         <h2>Rvs ringen:</h2>
          <div class="row">
            @foreach ($ringsRvs as $ringRvs)
            <div class="col-md-3 mb-3">
              <div class="card product-tile" >
                <div class="card-body">
                  <h5 class="card-title">{{$ringRvs->size}} mm</h5>
                  <p class="card-text">€{{$ringRvs->price}}</p>
                  <div class="form-group">
                    <label for="product1-amount">Aantal</label>
                    <input type="number" class="form-control" id="product1-amount" name="{{$ringRvs->id}}" min="1">
                  </div>
                  <div class="shoppingcart">
                    <button type="submit" name="button_id" value="{{$ringRvs->id}}" class="btn btn-secondary"><i class="fa-solid fa-cart-shopping addToCart"></i></button>
                  </div>
                </div>
              </div>
              {{-- <p class="hidden error">Toegevoegd aan winkelmand!</p> --}}
            </div>
            
            @endforeach
          </div> 
        </div>
      </form>
    </div>
  </div>
@endsection

@section('scripts')
    <script>
        console.log('Page specific script code goes here');
    </script>
@endsection