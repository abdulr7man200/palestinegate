@extends('layouts.app')
@section('content')
<style>
    .search-container {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        width: 90%;
        max-width: 850px;
    }
    .search-bar {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width: 100%;
        gap: 10px;
    }
    select {
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 16px;
        width: 45%;
        background: #fff;
    }
    .filters {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
        width: 100%;
    }
    .filters label {
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 5px;
        background: #f5f5f5;
        padding: 6px 12px;
        border-radius: 6px;
    }
    button {
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        background: #ffa726;
        color: white;
        cursor: pointer;
        transition: all 0.3s;
        width: 60%;
        max-width: 300px;
    }
    button:hover {
        background: #fb8c00;
    }
</style>

    <section class="site-hero inner-page overlay" style="background-image:url('{{ url('Frontend/images/Gaza.jpg') }}') "
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade">
                    <h1 class="heading mb-3">Rooms</h1>
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
          <form action="{{ route('showrooms', request()->id) }}" method="GET">
            <div class="search-container">
              <div class="search-bar">
                <select name="pricepernight" class="form-control">
                  <option value="" {{ request('pricepernight') == '' ? 'selected' : '' }}>Select Price Per Night</option>
                  <option value="lowest" {{ request('pricepernight') == 'lowest' ? 'selected' : '' }}>Lowest</option>
                  <option value="highest" {{ request('pricepernight') == 'highest' ? 'selected' : '' }}>Highest</option>
                  <option value="all" {{ request('pricepernight') == 'all' ? 'selected' : '' }}>All</option>
                </select>
                <select name="numberofbedrooms" class="form-control">
                  <option value="" {{ request('numberofbedrooms') == '' ? 'selected' : '' }}>Select Number Of Beds</option>
                  <option value="1" {{ request('numberofbedrooms') == '1' ? 'selected' : '' }}>1</option>
                  <option value="2" {{ request('numberofbedrooms') == '2' ? 'selected' : '' }}>2</option>
                  <option value="3" {{ request('numberofbedrooms') == '3' ? 'selected' : '' }}>3</option>
                  <option value="4" {{ request('numberofbedrooms') >= '4' ? 'selected' : '' }}>4+</option>
                </select>
              </div>
              <div class="filters">
                <label>
                  <input type="checkbox" name="has_ac" {{ request('has_ac') == 'on' ? 'checked' : '' }}>
                  Air Conditioning
                </label>
                <label>
                  <input type="checkbox" name="has_tv" {{ request('has_tv') == 'on' ? 'checked' : '' }}>
                  TV
                </label>
                <label>
                  <input type="checkbox" name="has_wifi" {{ request('has_wifi') == 'on' ? 'checked' : '' }}>
                  Wi-Fi
                </label>
              </div>
              <button type="submit" class="btn btn-primary">Check Availability</button>
            </div>
          </form>
        </div>
      </section>



    <section class="container2">
        <div class="card__container" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
            @foreach ($rooms as $room)
                <article class="card__article">
                    <img src="{{ asset('storage/' . $room->main_pic) }}" alt="image" class="card__img" style="width: 300px; height: 300px">
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
