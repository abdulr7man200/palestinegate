@extends('layouts.app')

@section('content')
    <section class="site-hero inner-page overlay" style="background-image: url('{{ url('Frontend/images/haram.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Contact Us</h1>
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
            <form action="{{ route('feedback.store') }}" method="POST" class="bg-white p-md-5 p-4 mb-5 border">
              @csrf
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="name">Name</label>
                  <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="col-md-6 form-group">
                  <label for="phone">Phone</label>
                  <input type="text" id="phone" name="phone" class="form-control" required>
                </div>
              </div>
          
              <div class="row">
                <div class="col-md-12 form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" class="form-control" required>
                </div>
              </div>
              
              <div class="row mb-4">
                <div class="col-md-12 form-group">
                  <label for="comment">Write Message</label>
                  <textarea name="comment" id="comment" class="form-control" cols="30" rows="8" required></textarea>
                </div>
              </div>
              
              <div class="row mb-4">
                <div class="col-md-12 form-group">
                  <label for="rating">Rating</label>
                  <select name="rating" id="rating" class="form-control" required>
                    <option value="1">1 - Poor</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5 - Excellent</option>
                  </select>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="submit" value="Send Message" class="btn btn-primary text-white font-weight-bold">
                </div>
              </div>
            </form>
          </div>
          
          <div class="col-md-5" data-aos="fade-up" data-aos-delay="200">
            <div class="row">
              <div class="col-md-10 ml-auto contact-info">
                <p><span class="d-block">Address:</span> <span> Arab American University</span></p>
                <p><span class="d-block">Phone:</span> <span> 059123456789</span></p>
                <p><span class="d-block">Email:</span> <span> bookingsystem@gmail.com</span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
