@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{ url('Frontend/css/cards.css')}}">

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
          <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
            <img src="{{url('Frontend/images/bed.jpg')}}" alt="image" class="card__img">
            <div class="card__data">
              <span class="card__description">Vancouver Mountains, Canada</span>
              <h2 class="card__title">The Great Path</h2>
              <a href="#" class="card__button">Read More</a>
            </div>
          </article>
    
          <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
            <img src="{{url('Frontend/images/bed.jpg')}}" alt="image" class="card__img">
            <div class="card__data">
              <span class="card__description">Poon Hill, Nepal</span>
              <h2 class="card__title">Starry Night</h2>
              <a href="#" class="card__button">Read More</a>
            </div>
          </article>
    
          <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
            <img src="{{url('Frontend/images/bed.jpg')}}" alt="image" class="card__img">
            <div class="card__data">
              <span class="card__description">Bojcin Forest, Serbia</span>
              <h2 class="card__title">Path Of Peace</h2>
              <a href="#" class="card__button">Read More</a>
            </div>
          </article>
    
          <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
            <img src="{{url('Frontend/images/bed.jpg')}}" alt="image" class="card__img">
            <div class="card__data">
              <span class="card__description">Sunset Beach, Maldives</span>
              <h2 class="card__title">Ocean Bliss</h2>
              <a href="#" class="card__button">Read More</a>
            </div>
          </article>    
          <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
            <img src="{{url('Frontend/images/bed.jpg')}}" alt="image" class="card__img">
            <div class="card__data">
              <span class="card__description">Sunset Beach, Maldives</span>
              <h2 class="card__title">Ocean Bliss</h2>
              <a href="#" class="card__button">Read More</a>
            </div>
          </article>    
          <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
            <img src="{{url('Frontend/images/bed.jpg')}}" alt="image" class="card__img">
            <div class="card__data">
              <span class="card__description">Sunset Beach, Maldives</span>
              <h2 class="card__title">Ocean Bliss</h2>
              <a href="#" class="card__button">Read More</a>
            </div>
          </article>
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

    <div class="section-divider"></div>


    <section class="container2">
      <h1 class="section-title">Stays</h1>

      <div class="card__container slider" style="display: flex; overflow: hidden; position: relative;">
        <div class="slider-track" style="display: flex; transition: transform 0.5s ease;">
          <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
            <img src="{{url('Frontend/images/bed.jpg')}}" alt="image" class="card__img">
            <div class="card__data">
              <span class="card__description">Vancouver Mountains, Canada</span>
              <h2 class="card__title">The Great Path</h2>
              <a href="#" class="card__button">Read More</a>
            </div>
          </article>
    
          <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
            <img src="{{url('Frontend/images/bed.jpg')}}" alt="image" class="card__img">
            <div class="card__data">
              <span class="card__description">Poon Hill, Nepal</span>
              <h2 class="card__title">Starry Night</h2>
              <a href="#" class="card__button">Read More</a>
            </div>
          </article>
    
          <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
            <img src="{{url('Frontend/images/bed.jpg')}}" alt="image" class="card__img">
            <div class="card__data">
              <span class="card__description">Bojcin Forest, Serbia</span>
              <h2 class="card__title">Path Of Peace</h2>
              <a href="#" class="card__button">Read More</a>
            </div>
          </article>
    
          <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
            <img src="{{url('Frontend/images/bed.jpg')}}" alt="image" class="card__img">
            <div class="card__data">
              <span class="card__description">Sunset Beach, Maldives</span>
              <h2 class="card__title">Ocean Bliss</h2>
              <a href="#" class="card__button">Read More</a>
            </div>
          </article>    
          <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
            <img src="{{url('Frontend/images/bed.jpg')}}" alt="image" class="card__img">
            <div class="card__data">
              <span class="card__description">Sunset Beach, Maldives</span>
              <h2 class="card__title">Ocean Bliss</h2>
              <a href="#" class="card__button">Read More</a>
            </div>
          </article>    
          <article class="card__article" style="flex: 0 0 calc((100% - 6rem) / 4);">
            <img src="{{url('Frontend/images/bed.jpg')}}" alt="image" class="card__img">
            <div class="card__data">
              <span class="card__description">Sunset Beach, Maldives</span>
              <h2 class="card__title">Ocean Bliss</h2>
              <a href="#" class="card__button">Read More</a>
            </div>
          </article>
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

</html>
<script src="{{ url('Frontend/js/cards.js')}}"></script>

@endsection
