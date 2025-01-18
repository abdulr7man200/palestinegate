@extends('layouts.app')
@section('content')


    <section class="site-hero inner-page overlay" style="background-image: url('{{ url('Frontend/images/nablus.jpg') }}');" data-stellar-background-ratio="0.5">
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
          <div class="rw check-availability" id="next">
              <div class="block-32" data-aos="fade-up" data-aos-offset="-200">
                  <div id="cars-form" class="filter-content">
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
                                  <button type="submit" class="btn btn-primary btn-block text-white">Filter Cars</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </section>

      <section class="container2">
        <div class="card__container" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
            @foreach ($cars as $car)
                <article class="card__article">
                    <img src="{{ asset('storage/' . $car->main_pic) }}" alt="image" class="card__img" style="width: 300px; height: 300px">
                    <div class="card__data">
                        <span class="card__description">{{ $car->location }}</span>
                        <h2 class="card__title">{{ $car->type }}({{ $car->model }})</h2>
                        <span class="card__description">{{ $car->price_per_day }}$</span>


                        <a href="{{ route('cardetails', $car->id) }}" class="card__button">View More</a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="view-more-container">
            {{ $cars->links('pagination::bootstrap-4') }} <!-- This will apply Bootstrap 4 styles to the pagination -->
        </div>

    </section>


@endsection
