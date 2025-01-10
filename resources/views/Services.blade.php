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

      <div class="scroll-wrapper">
        <button class="scroll-button left" onclick="scrollLeft()">&#8592;</button>
        <div class="scrolling-container" id="scrollContainer">
          <div class="card">
            <img src="https://via.placeholder.com/286x160" alt="Card image">
            <div class="card-body">
              <h5 class="card-title">Card 1</h5>
              <p class="card-text">This is the first card in the scrolling container.</p>
              <a href="#" class="btn">Learn More</a>
            </div>
          </div>
          <div class="card">
            <img src="https://via.placeholder.com/286x160" alt="Card image">
            <div class="card-body">
              <h5 class="card-title">Card 2</h5>
              <p class="card-text">This is the second card in the scrolling container.</p>
              <a href="#" class="btn">Learn More</a>
            </div>
          </div>
          <div class="card">
            <img src="https://via.placeholder.com/286x160" alt="Card image">
            <div class="card-body">
              <h5 class="card-title">Card 3</h5>
              <p class="card-text">This is the third card in the scrolling container.</p>
              <a href="#" class="btn">Learn More</a>
            </div>
          </div>
          <div class="card">
            <img src="https://via.placeholder.com/286x160" alt="Card image">
            <div class="card-body">
              <h5 class="card-title">Card 3</h5>
              <p class="card-text">This is the third card in the scrolling container.</p>
              <a href="#" class="btn">Learn More</a>
            </div>
          </div>
          <div class="card">
            <img src="https://via.placeholder.com/286x160" alt="Card image">
            <div class="card-body">
              <h5 class="card-title">Card 3</h5>
              <p class="card-text">This is the third card in the scrolling container.</p>
              <a href="#" class="btn">Learn More</a>
            </div>
          </div>
          <div class="card">
            <img src="https://via.placeholder.com/286x160" alt="Card image">
            <div class="card-body">
              <h5 class="card-title">Card 3</h5>
              <p class="card-text">This is the third card in the scrolling container.</p>
              <a href="#" class="btn">Learn More</a>
            </div>
          </div>
          <div class="card">
            <img src="https://via.placeholder.com/286x160" alt="Card image">
            <div class="card-body">
              <h5 class="card-title">Card 3</h5>
              <p class="card-text">This is the third card in the scrolling container.</p>
              <a href="#" class="btn">Learn More</a>
            </div>
          </div>
        </div>
        <button class="scroll-button right" onclick="scrollRight()">&#8594;</button>
      </div>
    
</html>

@endsection
