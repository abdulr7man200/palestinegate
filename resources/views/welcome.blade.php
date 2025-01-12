@extends('layouts.app')
@section('content')



    <!-- END head -->

    <section class="site-hero overlay"          style="background-image: url('{{ url('Frontend/images/Jerusalem.jpg') }}');"
    data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade-up">
            <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To Palestine Gate <span class="fa fa-star text-primary">
            <h1 class="heading">Find your best stay</h1>
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

            <!-- Toggle between Cars and Stays -->
            <div class="filter-toggle mb-4 text-center">
              <button id="stays-btn" class="btn btn-primary active">Stays</button>
              <button id="cars-btn" class="btn btn-secondary">Cars</button>
            </div>

            <!-- Forms container -->
            <div id="stays-form" class="filter-content">
              <!-- Stays Form -->
              <form action="#">
                <div class="row">
                  <!-- Property Type Filter -->
                  <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                    <label for="property_type" class="font-weight-bold text-black">Property Type</label>
                    <select id="property_type" class="form-control">
                      <option>Apartment</option>
                      <option>House</option>
                      <option>Villa</option>
                      <option>Condo</option>
                    </select>
                  </div>

                  <!-- City Filter -->
                  <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                    <label for="stays_city" class="font-weight-bold text-black">City</label>
                    <input type="text" id="stays_city" class="form-control" placeholder="Enter city">
                  </div>

                  <!-- Number of Bedrooms Filter -->
                  <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                    <label for="bedrooms" class="font-weight-bold text-black">Number of Bedrooms</label>
                    <select id="bedrooms" class="form-control">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4+</option>
                    </select>
                  </div>

                  <!-- Price Sort Filter -->
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

            <div id="cars-form" class="filter-content d-none">
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




    <section class="py-5 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
            <figure class="img-absolute">
              <img src="{{ url("Frontend/images/JerusalemHotel.jpg")}}" alt="Image" class="img-fluid">
            </figure>
            <img src="{{ url("Frontend/images/JerBed.jpeg")}}" alt="Image" class="img-fluid rounded">
          </div>
          <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
            <h2 class="heading">Welcome!</h2>
            <p class="mb-4">Palestine is a historic and beautiful travel destination with great tourism potential. However, travelers often face challenges like limited information, fragmented booking systems, and language barriers. To address these issues, the "Palestine Gate" project aims to simplify travel and booking in Palestine.</p>
            <p><a href="{{route("aboutus")}}" class="btn btn-primary text-white py-2 mr-3">Learn More</a> <span class="mr-3 font-family-serif"></span></p>
          </div>
        </div>
      </div>
    </section>


    <section class="section slider-section bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading" data-aos="fade-up">Cars</h2>
            <p data-aos="fade-up" data-aos-delay="100">Take a look at some of the cars we have</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                @forelse ($cars as $car)
                    <div class="slider-item">
                    <a href=""  ><img src="{{ asset('storage/' . $car->carPics->first()->path ) }}" alt="Image placeholder" class="img-fluid" style="height: 500px;"></a>
                  </div>
                @empty
                <div class="alert alert-warning" role="alert">
                    No items found.
                  </div>
                @endforelse

            </div>
          </div>

        </div>
      </div>
    </section>


    <section class="section slider-section bg-light">
        <div class="container">
          <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7">
              <h2 class="heading" data-aos="fade-up">Stays</h2>
              <p data-aos="fade-up" data-aos-delay="100">Take a look at some of the stays we have</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                  @forelse ($stays as $stay)
                      <div class="slider-item">
                      <a href=""  ><img src="{{ asset('storage/' . $stay->staysPics->first()->path ) }}" alt="Image placeholder" class="img-fluid" style="height: 500px;"></a>
                    </div>
                  @empty
                  <div class="alert alert-warning" role="alert">
                      No items found.
                    </div>
                  @endforelse

              </div>
            </div>

          </div>
        </div>
      </section>

      <section class="section slider-section bg-light">
        <div class="container">
          <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7">
              <h2 class="heading" data-aos="fade-up">Recommended</h2>
              <p data-aos="fade-up" data-aos-delay="100">We recommend you </p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                @forelse ($recommendedItems as $recommendedItem)
                <div class="slider-item">
                    <a href="#">
                        <img
                            src="{{ $recommendedItem instanceof \App\Models\Cars ?
                                    asset('storage/' . $recommendedItem->carPics->first()->path) :
                                    asset('storage/' . $recommendedItem->staysPics->first()->path) }}"
                            alt="Image placeholder"
                            class="img-fluid"
                            style="height: 500px;"
                        >
                    </a>
                </div>
            @empty
                <div class="alert alert-warning" role="alert">
                    No items found.
                </div>
            @endforelse


              </div>
            </div>

          </div>
        </div>
      </section>

  </body>
</html>
@endsection
