@extends('site.layouts.main')

@section('title', 'Checkout')

@section('main-section')

<style>
  /* Simplified Custom CSS */
  .checkout-section {
    background-color: #f8f9fa;
    padding: 40px 0;
  }

  .checkout-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }

  .checkout-title {
    font-size: 22px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
  }

  .form-label {
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
  }

  .form-control {
    border-radius: 5px;
    border: 1px solid #ddd;
    padding: 8px;
  }

  .form-select {
    border-radius: 5px;
    border: 1px solid #ddd;
    padding: 8px;
  }

  .summary-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    height: 100%;
  }

  .summary-title {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
  }

  .summary-text {
    font-size: 14px;
    color: #555;
  }

  .summary-total {
    font-weight: bold;
    color: #333;
  }

  .promo-input {
    border-radius: 5px 0 0 5px;
  }

  .promo-btn {
    border-radius: 0 5px 5px 0;
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    color: #333;
  }

  .promo-btn:hover {
    background-color: #e9ecef;
  }

  .continue-btn {
    background-color: #DEA193;
    border: none;
    padding: 10px;
    border-radius: 5px;
    font-weight: 500;
    color: white;
  }

  .continue-btn:hover {
    background-color: #D18C7D;
  }

  .cancel-btn {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 5px;
    color: #333;
  }

  .cancel-btn:hover {
    background-color: #e9ecef;
  }

  .cart-item-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
  }

  .error-text {
    font-size: 12px;
    color: #dc3545;
    margin-top: 5px;
  }

  .button-group {
    display: flex;
    gap: 10px;
    justify-content: flex-end;
  }

  @media (max-width: 767px) {
    .checkout-container {
      margin-bottom: 20px;
    }

    .summary-card {
      margin-top: 20px;
    }

    .button-group {
      flex-direction: column;
    }
  }
</style>

<section class="checkout-section">
  <div class="container">
    <div class="row">
      <!-- Checkout Form -->
      <div class="col-lg-8">
        <form action="{{ route('cart.store.checkout') }}" method="post">
          @csrf
          <div class="checkout-container">
            <h5 class="checkout-title">Shipping Details</h5>
            <button type="button" class="btn btn-outline-warning btn-sm" id="clearAddress"
              onclick="clearForm()" title="Clear Address">
              <i class="bi bi-arrow-clockwise me-1"></i> Clear
            </button>

            <div class="row">
              <div class="col-6 mb-3">
                <label class="form-label">Name</label>
                <input type="text" id="typeText" placeholder="Enter your name" class="form-control" name="name" value="{{ old('name',$user->name) }}" />
                @error('name')
                <div class="error-text">{{ $message }}</div>
                @enderror
              </div>

              <div class="col-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" id="typeEmail" placeholder="example@gmail.com" class="form-control" name="email" value="{{ old('email', $user->email) }}" />
                @error('email')
                <div class="error-text">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <hr class="my-4" />

            <div class="row">
              <div class="col-6 mb-3">
                <label class="form-label">Address</label>
                <input type="text" id="address" value="{{ old('address', $shippingInfo?->address) }}" name="address" class="form-control" placeholder="Enter your address">
                @error('address')
                <div class="error-text">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-6 mb-3">
                <label class="form-label">Phone Number</label>
                <input type="tel" id="phone_number" value="{{ old('phone_number', $shippingInfo?->phone_number) }}" name="phone_number" class="form-control" placeholder="Enter your phone number">
                @error('phone_number')
                <div class="error-text">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-6 mb-3">
                <label class="form-label">Landmark</label>
                <input type="text" id="landmark" value="{{ old('landmark', $shippingInfo?->landmark) }}" name="landmark" class="form-control" placeholder="Enter landmark (Optional)">
                @error('landmark')
                <div class="error-text">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-6 mb-3">
                <label class="form-label">Postal Code</label>
                <input type="number" id="postal_code" value="{{ old('postal_code', $shippingInfo?->postal_code) }}" name="postal_code" class="form-control">
                @error('postal_code')
                <div class="error-text">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-6 mb-3">
                <label class="form-label">Street No.</label>
                <input type="number" id="street_no" value="{{ old('street_no', $shippingInfo?->street_no) }}" name="street_no" class="form-control" placeholder="Enter street number">
                @error('street_no')
                <div class="error-text">{{ $message }}</div>
                @enderror
              </div>
              <div class="col-6 mb-3">
                <label class="form-label">State</label>
                <select class="form-select" name="state" id="">
                  <option value="koshi" @selected(old('state', 'koshi' )=='koshi' )>Koshi</option>
                  <option value="madesh" @selected(old('state', 'madesh' )=='madesh' )>Madhesh</option>
                  <option value="gandaki" @selected(old('state', 'gandaki' )=='gandaki' )>Gandaki</option>
                  <option value="lumbini" @selected(old('state', 'lumbini' )=='lumbini' )>Lumbini</option>
                  <option value="karnali" @selected(old('state', 'karnali' )=='karnali' )>Karnali</option>
                  <option value="sudurpaschim" @selected(old('state', 'sudurpaschim' )=='sudurpaschim' )>Sudurpaschim</option>
                </select>
                @error('state')
                <div class="error-text">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="form-check mb-3">
              <input class="form-check-input" type="hidden" value="0" name="is_permanent" />
              <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault1" name="is_permanent" {{ old('is_permanent') ? 'checked' : '' }} />
              <label class="form-check-label" for="flexCheckDefault1">Is Permanent Address</label>
              @error('is_permanent')
              <div class="error-text">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-12 mb-3">
              <h5 class="checkout-title">Payment Method</h5>
              <div class="mb-3">
                <select class="form-select form-select-lg" name="payment_method" id="payment_method">
                  <option selected disabled>Select Payment</option>
                  <option value="cod">Cash on Delivery (COD)</option>
                  <option value="khalti">Pay with Khalti</option>
                </select>
              </div>
            </div>

            <div class="button-group">
              <a href="{{ route('cart.getCarts') }}" class="btn cancel-btn">Cancel</a>
              <button type="submit" class="btn continue-btn">Confirm Checkout</button>
            </div>
          </div>

        </form>
      </div>

      <!-- Order Summary -->
      <div class="col-lg-4">
        <div class="summary-card">
          <h6 class="summary-title">Order Summary</h6>
          <div class="d-flex justify-content-between mb-2">
            <span class="summary-text">Subtotal:</span>
            <span class="summary-text" id="subtotal">Rs {{ number_format($subtotal, 2) }}</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="summary-text">Discount:</span>
            <span class="summary-text text-danger" id="discount">-Rs {{ number_format($discount_amount, 2) }}</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span class="summary-text">Shipping cost:</span>
            <span class="summary-text" id="shipping">+{{ $shipping_cost }}</span>
          </div>
          <hr />
          <div class="d-flex justify-content-between mb-3">
            <span class="summary-text">Total price:</span>
            <span class="summary-total" id="total">Rs {{ number_format($final_total, 2) }}</span>
          </div>

          <!-- <div class="input-group mb-4">
            <input type="text" class="form-control promo-input" id="promo-code" placeholder="Promo code" />
            <button class="btn promo-btn" id="apply-promo">Apply</button>
          </div> -->

          <hr />
          <h6 class="summary-title">Items in Cart</h6>
          @foreach ($carts as $cart)
          <div class="d-flex align-items-center mb-3">
            <div class="me-3">
              <img src="{{ asset('storage/' . $cart->product->primary_image) }}"
                class="cart-item-img" />
            </div>
            <div>
              <a href="#" class="nav-link p-0 text-dark">
                {{ $cart->product->product_name }} <br />
                <small class="text-muted">Darkblue color</small>
              </a>
              <div class="summary-text">Rs {{ number_format($cart->product->actual_amount, 2) }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>


<script>
  function clearForm() {
    document.querySelectorAll('#name, #email, #address, #phone_number, #landmark, #postal_code, #street_no').forEach(input => {
      input.value = '';
    });
    document.querySelector('select[name="state"]').selectedIndex = 0;
    document.querySelector('input[name="is_permanent"]').checked = false;
  }
</script>


@endsection