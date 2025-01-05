@extends('layouts.app')
@section('content')


    <section class="site-hero inner-page overlay"  style="background-image: " data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Stays</h1>
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
          
  
              <div id="stays-form" class="filter-content">
                <form action="#">
                  <div class="row">
                    <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                      <label for="property_type" class="font-weight-bold text-black">Property Type</label>
                      <select id="property_type" class="form-control">
                        <option>Apartment</option>
                        <option>House</option>
                        <option>Villa</option>
                        <option>Condo</option>
                      </select>
                    </div>
                
                    <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                      <label for="stays_city" class="font-weight-bold text-black">City</label>
                      <input type="text" id="stays_city" class="form-control" placeholder="Enter city">
                    </div>
                
                    <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                      <label for="bedrooms" class="font-weight-bold text-black">Number of Bedrooms</label>
                      <select id="bedrooms" class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4+</option>
                      </select>
                    </div>
                
                    <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                      <label for="stays_price_sort" class="font-weight-bold text-black">Price</label>
                      <select id="stays_price_sort" class="form-control">
                        <option>Lowest</option>
                        <option>Highest</option>
                        <option>All</option>
                      </select>
                    </div>
                
                  </div>
                </form>
              </div>
          
      
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
