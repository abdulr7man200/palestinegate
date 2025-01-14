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
              <form action="{{ route('showstays') }}" method="GET">
                <div class="row">
                    <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                        <label for="type" class="font-weight-bold text-black">Property Type</label>
                        <select id="type" name="type" class="form-control">
                            <option value="">Select Type</option>
                            <option value="hotels" {{ request('type') == 'hotels' ? 'selected' : '' }}>Hotels
                            </option>
                            <option value="apartments" {{ request('type') == 'apartments' ? 'selected' : '' }}>
                                Apartments</option>
                            <option value="chales" {{ request('type') == 'chales' ? 'selected' : '' }}>Chales
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                        <label for="city" class="font-weight-bold text-black">City</label>
                        <select id="city" name="city" class="form-control">
                            <option value="">Select City</option>
                            <option value="jerusalem" {{ request('city') == 'jerusalem' ? 'selected' : '' }}>
                                Jerusalem</option>
                            <option value="nablus" {{ request('city') == 'nablus' ? 'selected' : '' }}>Nablus
                            </option>
                            <option value="ramallah" {{ request('city') == 'ramallah' ? 'selected' : '' }}>
                                Ramallah</option>
                            <option value="bethlehem" {{ request('city') == 'bethlehem' ? 'selected' : '' }}>
                                Bethlehem</option>
                            <option value="hebron" {{ request('city') == 'hebron' ? 'selected' : '' }}>Hebron
                            </option>
                            <option value="gaza" {{ request('city') == 'gaza' ? 'selected' : '' }}>Gaza
                            </option>
                            <option value="tulkarem" {{ request('city') == 'tulkarem' ? 'selected' : '' }}>
                                Tulkarem</option>
                            <option value="jenin" {{ request('city') == 'jenin' ? 'selected' : '' }}>Jenin
                            </option>
                            <option value="tubas" {{ request('city') == 'tubas' ? 'selected' : '' }}>Tubas
                            </option>
                            <option value="salfit" {{ request('city') == 'salfit' ? 'selected' : '' }}>Salfit
                            </option>
                            <option value="qalqilya" {{ request('city') == 'qalqilya' ? 'selected' : '' }}>
                                Qalqilya</option>
                            <option value="jericho" {{ request('city') == 'jericho' ? 'selected' : '' }}>
                                Jericho</option>
                            <option value="ramallah" {{ request('city') == 'ramallah' ? 'selected' : '' }}>
                                Ramallah</option>
                            <option value="deir al-balah"
                                {{ request('city') == 'deir al-balah' ? 'selected' : '' }}>Deir al-Balah
                            </option>
                            <option value="khan_younis"
                                {{ request('city') == 'khan_younis' ? 'selected' : '' }}>Khan Younis</option>
                            <option value="rafah" {{ request('city') == 'rafah' ? 'selected' : '' }}>Rafah
                            </option>
                        </select>
                    </div>


                    <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                        <label for="stays_price_sort" class="font-weight-bold text-black">Price</label>
                        <select id="stays_price_sort" name="price" class="form-control">
                            <option value="">Select Price</option>
                            <option value="lowest" {{ request('price') == 'lowest' ? 'selected' : '' }}>Lowest</option>
                            <option value="highest" {{ request('price') == 'highest' ? 'selected' : '' }}>Highest</option>
                            <option value="all" {{ request('price') == 'all' ? 'selected' : '' }}>All</option>
                        </select>
                    </div>


                    <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                        <label for="numberofbedrooms" class="font-weight-bold text-black">Number Of Bedrooms</label>
                        <select id="numberofbedrooms" name="numberofbedrooms" class="form-control">
                            <option value="">Select Number Of Bedrooms</option>
                            <option value="1" {{ request('numberofbedrooms') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ request('numberofbedrooms') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ request('numberofbedrooms') == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ request('numberofbedrooms') >= '4' ? 'selected' : '' }}>+4</option>
                        </select>
                    </div>


                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-md-6 col-lg-3 align-self-end">
                        <button type="submit" class="btn btn-primary btn-block text-white">Check
                            Availability</button>
                    </div>
                </div>
            </form>
            </div>

            <div id="cars-form" class="filter-content d-none">
              <!-- Cars Form -->
              <form action="{{ route('showcars') }}" method="GET">
                <div class="row">
                    <!-- Car Type Filter -->
                    <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                      <label for="type" class="font-weight-bold text-black">Car Type</label>
                      <input
                          type="text"
                          id="type"
                          name="type"
                          class="form-control"
                          placeholder="Search car type (e.g., SUV)"
                          value="{{ request('type') }}">
                  </div>
                    <!-- Location Filter -->
                    <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                        <label for="location" class="font-weight-bold text-black">Location</label>
                        <select id="location" name="location" class="form-control">
                          <option value="">Select City</option>
                          <option value="jerusalem" {{ request('location') == 'jerusalem' ? 'selected' : '' }}>
                              Jerusalem</option>
                          <option value="nablus" {{ request('location') == 'nablus' ? 'selected' : '' }}>Nablus
                          </option>
                          <option value="ramallah" {{ request('location') == 'ramallah' ? 'selected' : '' }}>
                              Ramallah</option>
                          <option value="bethlehem" {{ request('location') == 'bethlehem' ? 'selected' : '' }}>
                              Bethlehem</option>
                          <option value="hebron" {{ request('location') == 'hebron' ? 'selected' : '' }}>Hebron
                          </option>
                          <option value="gaza" {{ request('location') == 'gaza' ? 'selected' : '' }}>Gaza
                          </option>
                          <option value="tulkarem" {{ request('location') == 'tulkarem' ? 'selected' : '' }}>
                              Tulkarem</option>
                          <option value="jenin" {{ request('location') == 'jenin' ? 'selected' : '' }}>Jenin
                          </option>
                          <option value="tubas" {{ request('location') == 'tubas' ? 'selected' : '' }}>Tubas
                          </option>
                          <option value="salfit" {{ request('location') == 'salfit' ? 'selected' : '' }}>Salfit
                          </option>
                          <option value="qalqilya" {{ request('location') == 'qalqilya' ? 'selected' : '' }}>
                              Qalqilya</option>
                          <option value="jericho" {{ request('location') == 'jericho' ? 'selected' : '' }}>
                              Jericho</option>
                          <option value="ramallah" {{ request('location') == 'ramallah' ? 'selected' : '' }}>
                              Ramallah</option>
                          <option value="deir al-balah"
                              {{ request('location') == 'deir al-balah' ? 'selected' : '' }}>Deir al-Balah
                          </option>
                          <option value="khan_younis"
                              {{ request('location') == 'khan_younis' ? 'selected' : '' }}>Khan Younis</option>
                          <option value="rafah" {{ request('location') == 'rafah' ? 'selected' : '' }}>Rafah
                          </option>
                        </select>
                    </div>

                    <!-- Price Filter -->
                    <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                        <label for="price_sort" class="font-weight-bold text-black">Price</label>
                        <select id="price_sort" name="price" class="form-control">
                            <option value="">Select Price</option>
                            <option value="lowest" {{ request('price') == 'lowest' ? 'selected' : '' }}>Lowest</option>
                            <option value="highest" {{ request('price') == 'highest' ? 'selected' : '' }}>Highest</option>
                        </select>
                    </div>
                </div>



                <div class="row justify-content-center mt-4">
                    <div class="col-md-6 col-lg-3 align-self-end">
                        <button type="submit" class="btn btn-primary btn-block text-white">Check Availability</button>
                    </div>
                </div>
            </form>
            </div>

            <!-- Centered Check Availability Button -->
            {{-- <div class="row justify-content-center mt-4">
              <div class="col-md-6 col-lg-3 align-self-end">
                <button class="btn btn-primary btn-block text-white">Check Availability</button>
              </div>
            </div> --}}

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
        <div class="row justify-content-center">
          <div class="col-md-12 slider-container">
            <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
              @forelse ($cars as $car)
                <div class="slider-item">
                  <a href="{{ route('cardetails', $car->id) }}">
                    <img src="{{ asset('storage/' . $car->carPics->first()->path ) }}" alt="Image placeholder" class="img-fluid" style="height: 500px;">
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





      <section class="section slider-section bg-light">
        <div class="container">
          <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7">
              <h2 class="heading" data-aos="fade-up">Stays</h2>
              <p data-aos="fade-up" data-aos-delay="100">Take a look at some of the Stays we have</p>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-12 slider-container">
              <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                @forelse ($stays as $stay)
                <div class="slider-item">
                <a href="{{ route('staydetails', $stay->id) }}"  ><img src="{{ asset('storage/' . $stay->staysPics->first()->path ) }}" alt="Image placeholder" class="img-fluid" style="height: 500px;"></a>
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
              <div class="col-md-12 slider-container">

                  <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                    @forelse ($recommendedItems as $recommendedItem)
                    <div class="slider-item">
                        <a href="{{ $recommendedItem instanceof \App\Models\Cars ? route('cardetails', $recommendedItem->id) : route('staydetails', $recommendedItem->id) }}">
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
                </div>
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
