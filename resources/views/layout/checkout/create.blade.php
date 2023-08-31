@extends('layout.app')
@section('body')
    {{--  @push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        updateCartHTML();
        sendCart();
    });
</script>
@endpush  --}}
    <section class="checkout bg-black bg-opacity-25">
        <div class="row p-5">
            <div class="col-75">
                <div class="container">
                    <form action="{{ route('order.sotre', ['id' => $cart->id]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-50">
                                <h3>Billing Address</h3>
                                {{--  <label for="fname"><i class="fa fa-user"></i> Full Name</label>  --}}
                                {{--  <input type="text" id="fname" name="full_name" value="{{ $cart->user->full_name }}">  --}}
                                {{--  <label for="email"><i class="fa fa-envelope"></i> Email</label>  --}}
                                {{--  <input type="text" id="email" name="email" value="{{ $cart->user->email }}">  --}}
                                <label for="phone"><i class="fa fa-envelope"></i> Phone</label>
                                <input type="text" id="phone" name="phone" value="{{ $cart->user->phone }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                <input type="text" id="adr" name="address" value="{{ $cart->user->address }}">
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="row">
                                    <div class="col-50">
                                        <label for="City" class="form-label m-0" >City</label>
                                        <select name="city" class="selectpicker mb-3 text-white w-100"
                                            data-live-search="true" title="Select City" id="City" required>
                                            <option class="d-none"></option>
                                            @foreach ($states as $state)
                                                <optgroup label="{{ $state->name }}">
                                                    @foreach ($state->city as $city)
                                                        @if (old('city') == $state->id . '-' . $city->id)
                                                            <option value="{{ $state->id . '-' . $city->id }}" selected>
                                                                {{ $city->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $state->id . '-' . $city->id }}">
                                                                {{ $city->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                            <!-- Add more options as needed -->
                                        </select>
                                        @error('city')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{--  <div class="col-50">
              <h3>Payment</h3>
              <label for="fname">Accepted Cards</label>
              <div class="icon-container">
                <i class="fa fa-cc-visa" style="color:navy;"></i>
                <i class="fa fa-cc-amex" style="color:blue;"></i>
                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                <i class="fa fa-cc-discover" style="color:orange;"></i>
              </div>
              <label for="cname">Name on Card</label>
              <input type="text" id="cname" name="cardname" placeholder="John More Doe">
              <label for="ccnum">Credit card number</label>
              <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
              <label for="expmonth">Exp Month</label>
              <input type="text" id="expmonth" name="expmonth" placeholder="September">

              <div class="row">
                <div class="col-50">
                  <label for="expyear">Exp Year</label>
                  <input type="text" id="expyear" name="expyear" placeholder="2018">
                </div>
                <div class="col-50">
                  <label for="cvv">CVV</label>
                  <input type="text" id="cvv" name="cvv" placeholder="352">
                </div>
              </div>
            </div>  --}}

                        </div>
                        <input type="submit" value="Order now" class="btn">
                    </form>
                </div>
            </div>

            <div class="col-25">
                <div class="container">
                    <h4>Cart
                        <span class="price">
                            <i class="fa fa-shopping-cart"></i>
                            <b>{{ count($cart->items) }}</b>
                        </span>
                    </h4>
                    @foreach ($cart->items as $item)
                        <p>
                            <a href="{{ route('product.show', ['product' => $item->product->id]) }}">
                                {{ $item->product->name }} ({{ $item->quantity }})
                            </a> <span class="price">${{ $item->product->price * $item->quantity }}</span>
                        </p>
                    @endforeach
                    <hr>
                    <p>Total <span class="price" style="color:rgb(42, 209, 0)"><b>${{ $cartTotal }}</b></span></p>
                </div>
            </div>
        </div>
    </section>
@endsection
