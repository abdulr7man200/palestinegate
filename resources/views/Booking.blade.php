@extends('layouts.app')
@section('content')


    <section class="site-hero inner-page overlay"  style="background-image: url('{{ url('Frontend/images/Baitlahm.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Name</h1>
            <ul class="custom-breadcrumbs mb-4">

            </ul>
          </div>
        </div>
      </div>

      <a class="mouse smoothscroll" href="#next">
        <div class="mouse-icon">
          <span class="mouse-wheel"></span>
        </div>
      </a>
    </section>


    <section class="section contact-section" id="next">
        <div class="container">
            <div class="row">
                <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
                    <form action="{{ route('payment') }}" method="post" class="bg-white p-md-5 p-4 mb-5 border">
                        @csrf
                        <input type="hidden" id="booking_id" name="booking_id" class="form-control" value="{{ $booking->id }}">

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="text-black font-weight-bold" for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="text-black font-weight-bold" for="phone">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="text-black font-weight-bold" for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="payment_method">Payment Method</label>
                            <select name="payment_method" id="payment_method" class="form-control">
                                <option value="new" {{ old('payment_method') == 'new' ? 'selected' : '' }}>Add New Payment Method</option>
                                <option value="existing" {{ old('payment_method') == 'existing' ? 'selected' : '' }}>Use Existing Payment Method</option>
                            </select>
                            @error('payment_method')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id="new_payment_fields" style="{{ old('payment_method') == 'new' ? 'display:block;' : 'display:none;' }}">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="cardholder_name">Cardholder Name</label>
                                    <input type="text" name="cardholder_name" class="form-control" value="{{ old('cardholder_name') }}" required>
                                    @error('cardholder_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="card_number">Credit Card Number</label>
                                    <input type="text" name="card_number" class="form-control" value="{{ old('card_number') }}" maxlength="16" required>
                                    @error('card_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="expiry_date">Expiration Date</label>
                                    <input type="text" name="expiry_date" class="form-control" value="{{ old('expiry_date') }}" placeholder="MM/YY" required>
                                    @error('expiry_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="cvv">CVV</label>
                                    <input type="text" name="cvv" class="form-control" value="{{ old('cvv') }}" maxlength="3" required>
                                    @error('cvv')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div id="existing_payment_fields" style="{{ old('payment_method') == 'existing' ? 'display:block;' : 'display:none;' }}">
                            <div class="form-group">
                                <label for="payment_id">Select Existing Payment</label>
                                <select name="payment_id" id="payment_id" class="form-control">
                                    @foreach(auth()->user()->payments as $payment)
                                        <option value="{{ $payment->id }}" {{ old('payment_id') == $payment->id ? 'selected' : '' }}>
                                            {{ $payment->name }} - **** **** **** {{ substr(Crypt::decryptString($payment->card_number), -4) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('payment_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12 form-group">
                                <label class="text-black font-weight-bold" for="note">Notes</label>
                                <textarea name="note" id="note" class="form-control" cols="30" rows="8">{{ old('note') }}</textarea>
                                @error('note')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="submit" value="Reserve Now" class="btn btn-primary text-white py-3 px-5 font-weight-bold">
                            </div>
                        </div>
                    </form>

                </div>

                <div class="col-md-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="row">
                        <div class="col-md-10 ml-auto contact-info">
                        @if($stay)
                            <p><span class="d-block"></span> <img src="{{ asset('storage/' . $stay->staysPics->first()->path) }}" alt="Stay Image" class="img-fluid" style="max-width: 100%;"></p>
                            <p><span class="d-block">Stay Details:</span> <span class="text-black">{{ $stay->name }}</span></p>
                            <p><span class="d-block">Location:</span> <span class="text-black">{{ $stay->location }}</span></p>
                            <p><span class="d-block">Price:</span> <span class="text-black">${{ $stay->price }}</span></p>
                        @elseif($car)
                            <p><span class="d-block"></span> <img src="{{ asset('storage/' . $car->carPics->first()->path) }}" alt="Car Image" class="img-fluid" style="max-width: 100%;"></p>
                            <p><span class="d-block">Car Details:</span> <span class="text-black">{{ $car->type }}</span></p>
                            <p><span class="d-block">Model:</span> <span class="text-black">{{ $car->model }}</span></p>
                            <p><span class="d-block">Year:</span> <span class="text-black">{{ $car->year }}</span></p>
                            <p><span class="d-block">Location:</span> <span class="text-black">{{ $car->location }}</span></p>
                            <p><span class="d-block">Total Price:</span> <span class="text-black">${{ $booking->price }}</span></p>
                        @else
                            <p><span class="d-block">No details available for stay or car.</span></p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




      <script>
  document.addEventListener('DOMContentLoaded', function () {
    const paymentMethodSelect = document.getElementById('payment_method');
    const newPaymentFields = document.getElementById('new_payment_fields');
    const existingPaymentFields = document.getElementById('existing_payment_fields');

    if (paymentMethodSelect.value === 'new') {
        newPaymentFields.style.display = 'block';
        existingPaymentFields.style.display = 'none';
    } else if (paymentMethodSelect.value === 'existing') {
        newPaymentFields.style.display = 'none';
        existingPaymentFields.style.display = 'block';
    }

    // Event listener for changing payment method
    paymentMethodSelect.addEventListener('change', function () {
        if (this.value === 'new') {
            newPaymentFields.style.display = 'block';
            existingPaymentFields.style.display = 'none';
        } else {
            newPaymentFields.style.display = 'none';
            existingPaymentFields.style.display = 'block';
        }
    });
});

    </script>



@endsection
