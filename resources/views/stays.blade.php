@extends('layouts.app')
@section('content')
    <section class="site-hero inner-page overlay" style="background-image:url('{{ url('Frontend/images/Gaza.jpg') }}') " data-stellar-background-ratio="0.5">
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




                </div>
            </div>
        </div>
    </section>


    <section class="container2">
        <div class="card__container" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
            @foreach ($stays as $stay)
                <article class="card__article">
                    <img src="{{ asset('storage/' . $stay->staysPics->first()->path) }}" alt="image" class="card__img">
                    <div class="card__data">
                        <span class="card__description">{{ $stay->type }}</span>
                        <span class="card__description">{{ $stay->city }}</span>
                        <h2 class="card__title">{{ $stay->name }}({{ $stay->price }}$)</h2>
                        <a href="" class="card__button">View More</a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="view-more-container">
            {{ $stays->links() }} <!-- This will show the pagination links -->
        </div>
    </section>
@endsection
