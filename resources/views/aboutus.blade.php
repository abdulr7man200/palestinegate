@extends('layouts.app')
@section('content')


    <section class="site-hero inner-page overlay"  style="background-image: url('{{ url('Frontend/images/Baitlahm.jpg') }}');" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade">
            <h1 class="heading mb-3">About Us</h1>
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

    <section class="py-5 bg-light" id="next">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
            <figure class="img-absolute">
              <img src="{{url("Frontend/images/JerusalemHotel.jpg")}}" alt="Image" class="img-fluid">
            </figure>
            <img src="{{url("Frontend/images/Jerusalem.jpg")}}" alt="Image" class="img-fluid rounded">
          </div>
          <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
            <h2 class="heading">Welcome!</h2>
            <p class="mb-4">Palestine is a very historic, cultural, and naturally beautiful travel destination with a lot of potential for tourism. However, booking a place in Palestine has been quite a hassle for travelers while limited access to information and fragmented systems often make traveling into and around Palestine less optimal for tourists. Most of the time, it has been quite a hassle for travelers to book travel amenities in Palestine due to limited access to information, fragmentation of booking systems, and the barrier of language. Against this background, the project of a "Palestine Gate" arises.
                Palestine is a historic and beautiful travel destination with great tourism potential. However, travelers often face challenges like limited information, fragmented booking systems, and language barriers. To address these issues, the "Gate of Palestine" project aims to simplify travel and booking in Palestine.
                </p>
          </div>
          
        </div>
      </div>
    </section>

    <div class="container section">

      <div class="row justify-content-center text-center mb-5">
        <div class="col-md-7 mb-5">
          <h2 class="heading" data-aos="fade-up">Leadership</h2>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="block-2">
            <div class="flipper">
              <div class="front" style="background-image: url('{{ url('Frontend/images/Unknown_Person.jpg') }}');">
                <div class="box">
                  <h2>Abdulrhman Nihad</h2>
                  <p>Student</p>
                </div>
              </div>
              <div class="back">
                <blockquote>
                  <p>&ldquo;Just a student&rdquo;</p>
                </blockquote>
                <div class="author d-flex">
                  <div class="image mr-3 align-self-center">
                    <img src="{{ url("Frontend/images/Unknown_person.jpg")}}" alt="">
                  </div>
                  <div class="name align-self-center">Abdulrhman Nihad <span class="position">Student</span></div>
                </div>
              </div>
            </div>
          </div> 
        </div>

        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
          <div class="block-2"> 
            <div class="flipper">
              <div class="front" style="background-image: url('{{ url('Frontend/images/Unknown_Person.jpg') }}');">
                <div class="box">
                  <h2>Amal Abed</h2>
                  <p>Student</p>
                </div>
              </div>
              <div class="back">
                <blockquote>
                  <p>&ldquo;Just a student.&rdquo;</p>
                </blockquote>
                <div class="author d-flex">
                  <div class="image mr-3 align-self-center">
                    <img src="{{ url("Frontend/images/Unknown_person.jpg")}}" alt="">
                  </div>
                  <div class="name align-self-center">Amal Abed <span class="position">Student</span></div>
                </div>
              </div>
            </div>
          </div> 
        </div>

        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
          <div class="block-2">
            <div class="flipper">
              <div class="front" style="background-image: url('{{ url('Frontend/images/Unknown_Person.jpg') }}');">
                <div class="box">
                  <h2>Ahmad Wishahi</h2>
                  <p>Student</p>
                </div>
              </div>
              <div class="back">
                <blockquote>
                  <p>&ldquo;just a Student&rdquo;</p>
                </blockquote>
                <div class="author d-flex">
                  <div class="image mr-3 align-self-center">
                    <img src="{{ url("Frontend/images/Unknown_person.jpg")}}" alt="">
                  </div>
                  <div class="name align-self-center">Ahmad Wishahi <span class="position">Student</span></div>
                </div>
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>


   

    
    
  

</html>

@endsection
