@extends('layouts.app')
@section('content')


    <section class="site-hero inner-page overlay"  style="background-image: url('{{ url('Frontend/images/Nablus.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">Services</h1>
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



      <section class="container2">
        <h1 class="section-title">Stays</h1>

        <div class="card__container slider" style="display: flex; overflow: hidden; position: relative;">
          <div class="slider-track" style="display: flex; transition: transform 0.5s ease;">
            @forelse ($stays as $stay)
            <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
                <img src="{{ asset('storage/' . $stay->staysPics->first()->path ) }}" alt="image" class="card__img">
                <div class="card__data">
                  <span class="card__description">{{ $stay->name }}</span>
                  <h2 class="card__title">{{ $stay->type }}({{ $stay->city }})</h2>
                  <a href="#" class="card__button">View More</a>
                </div>
              </article>
            @empty
            @endforelse
          </div>
          <button class="slider-btn prev">
            <span class="btn-icon">&#8249;</span>
          </button>
          <button class="slider-btn next">
            <span class="btn-icon">&#8250;</span>
          </button>
        </div>
        <div class="view-more-container">
          <a href="#" class="view-more-btn">View More</a>
        </div>
      </section>

      <section class="container2">
        <h1 class="section-title">Cars</h1>

        <div class="card__container slider" style="display: flex; overflow: hidden; position: relative;">
          <div class="slider-track" style="display: flex; transition: transform 0.5s ease;">
            @forelse ($cars as $car)
            <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
                <img src="{{ asset('storage/' . $car->carPics->first()->path ) }}" alt="image" class="card__img">
                <div class="card__data">
                  <span class="card__description">{{ $car->type }}</span>
                  <h2 class="card__title">{{ $car->model }}({{ $car->year }})</h2>
                  <a href="#" class="card__button">View More</a>
                </div>
              </article>
            @empty
            @endforelse
          </div>
          <button class="slider-btn prev">
            <span class="btn-icon">&#8249;</span>
          </button>
          <button class="slider-btn next">
            <span class="btn-icon">&#8250;</span>
          </button>
        </div>
        <div class="view-more-container">
          <a href="#" class="view-more-btn">View More</a>
        </div>
      </section>
      <section class="container2">
        <h1 class="section-title">Flights</h1>
        <br>
        <h2 class="">Coming soon</h2>

      </section>

    


</html>


@endsection
