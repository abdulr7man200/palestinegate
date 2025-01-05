@extends('layouts.app')
@section('content')


    <section class="site-hero inner-page overlay" style="background-image: " data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Cars</h1>
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

    <section class="section bg-light pb-0">
        <div class="container">
          <div class="row check-availability" id="next">
            <div class="block-32" data-aos="fade-up" data-aos-offset="-200">
          

          
              <div id="cars-form" class="filter-content">
                <!-- Cars Form -->
                <form action="#">
                  <div class="row">
                    <!-- Vehicle Type Filter -->
                    <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                      <label for="vehicle_type" class="font-weight-bold text-black">Vehicle Type</label>
                      <select id="vehicle_type" class="form-control">
                        <option>Compact</option>
                        <option>SUV</option>
                        <option>Convertible</option>
                        <option>Minivan</option>
                        <option>Luxury</option>
                      </select>
                    </div>
                
                    <!-- City Filter -->
                    <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                      <label for="cars_city" class="font-weight-bold text-black">City</label>
                      <input type="text" id="cars_city" class="form-control" placeholder="Enter city">
                    </div>
                
                    <!-- Price Sort Filter -->
                    <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                      <label for="cars_price_sort" class="font-weight-bold text-black">Price</label>
                      <select id="cars_price_sort" class="form-control">
                        <option>Ascending</option>
                        <option>Descending</option>
                      </select>
                    </div>
                 
                  </div>
                </form>
              </div>
      
              <!-- Centered Check Availability Button -->
              <div class="row justify-content-center mt-4">
                <div class="col-md-6 col-lg-3 align-self-end">
                  <button class="btn btn-primary btn-block text-white">Check Availability</button>
                </div>
              </div>
      
            </div>
          </div>
        </div>
      </section>
  

@endsection
