@extends('layouts.app')
@section('content')
    <section class="site-hero inner-page overlay" style="background-image:url('{{ url('Frontend/images/Gaza.jpg') }}') "
        data-stellar-background-ratio="0.5">
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
            <div class="rw check-availability" id="next">
                <div class="block-32" data-aos="fade-up" data-aos-offset="-200">
                    <div id="stays-form" class="filter-content">
                        <form action="{{ route('showrooms', request()->id) }}" method="GET">
                            <div class="row">




                                <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                                    <label for="stays_price_sort" class="font-weight-bold text-black">Price Per
                                        Night</label>
                                    <select id="stays_price_sort" name="pricepernight" class="form-control">
                                        <option value="">Select Price Per Night</option>
                                        <option value="lowest" {{ request('pricepernight') == 'lowest' ? 'selected' : '' }}>
                                            Lowest</option>
                                        <option value="highest"
                                            {{ request('pricepernight') == 'highest' ? 'selected' : '' }}>Highest</option>
                                        <option value="all" {{ request('pricepernight') == 'all' ? 'selected' : '' }}>All
                                        </option>
                                    </select>
                                </div>


                                <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                                    <label for="numberofbedrooms" class="font-weight-bold text-black">Number Of Beds</label>
                                    <select id="numberofbedrooms" name="numberofbedrooms" class="form-control">
                                        <option value="">Select Number Of Beds</option>
                                        <option value="1" {{ request('numberofbedrooms') == '1' ? 'selected' : '' }}>1
                                        </option>
                                        <option value="2" {{ request('numberofbedrooms') == '2' ? 'selected' : '' }}>2
                                        </option>
                                        <option value="3" {{ request('numberofbedrooms') == '3' ? 'selected' : '' }}>3
                                        </option>
                                        <option value="4" {{ request('numberofbedrooms') >= '4' ? 'selected' : '' }}>+4
                                        </option>
                                    </select>
                                </div>

                                <!-- Additional Features (AC, Wi-Fi, TV) -->
                                <div class="row">
                                    <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="has_ac"
                                                name="has_ac" {{ request('has_ac') == 'on' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="has_ac">
                                                <strong>Air Conditioning</strong>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="has_tv"
                                                name="has_tv" {{ request('has_tv') == 'on' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="has_tv">
                                                <strong>TV</strong>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="has_wifi"
                                                name="has_wifi" {{ request('has_wifi') == 'on' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="has_wifi">
                                                <strong>Wi-Fi</strong>
                                            </label>
                                        </div>
                                    </div>
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




                </div>
            </div>
        </div>
    </section>


    <section class="container2">
        <div class="card__container" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
            @foreach ($rooms as $room)
                <article class="card__article">
                    <img src="{{ asset('storage/' . $room->room_pics->first()->path) }}" alt="image" class="card__img" style="width: 300px; height: 300px">
                    <div class="card__data">
                        <span class="card__description">{{ $room->stay->name }}</span>
                        <span class="card__description">room number: {{ $room->room_number }}</span>
                        <h2 class="card__title">{{ $room->pricepernight }}$</h2>
                        <a href="{{ route('roomdetails', $room->id) }}" class="card__button">View More</a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="view-more-container">
            {{ $rooms->links('pagination::bootstrap-4') }} <!-- This will apply Bootstrap 4 styles to the pagination -->
        </div>

    </section>
@endsection
