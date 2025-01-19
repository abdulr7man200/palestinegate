@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('Frontend/css/details.css') }}">

    <section class="site-hero inner-page overlay" style="background-image: url('{{ url('storage/' . $stay->banner) }}');"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade">
                    <h1 class="heading mb-3">{{ $stay->name }}</h1>
                </div>
            </div>
        </div>

        <a class="mouse smoothscroll" href="#next">
            <div class="mouse-icon">
                <span class="mouse-wheel"></span>
            </div>
        </a>
    </section>





    <div class="pd-wrap">
        <div class="container">
            <div class="heading-section">
                <h2>Stay Details</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="slider-container">
                        <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                            @forelse ($stay->staysPics as $image)
                                <div class="slider-item">
                                    <a>
                                        <img src="{{ asset('storage/' . $image->path) }}" alt="Stay Image" class="img-fluid"
                                            style="height: 500px;">
                                    </a>
                                </div>
                            @empty
                                <div class="alert alert-warning" role="alert">
                                    No images found.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>



                <div class="col-md-6">
                    <div class="product-dtl">
                        <div class="product-info">
                            <div class="product-name">{{ $stay->name }}</div>
                            <p>
                                {{ $stay->type }}
                            </p>
                            <div class="reviews-counter">
                                <div class="rate">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($averageRating >= $i)
                                            <i class="fas fa-star text-warning"></i> <!-- Filled star -->
                                        @elseif ($averageRating >= $i - 0.5)
                                            <i class="fas fa-star-half-alt text-warning"></i> <!-- Half-filled star -->
                                        @else
                                            <i class="fas fa-star"></i> <!-- Empty star -->
                                        @endif
                                    @endfor
                                </div>
                                <!-- Display the total reviews count -->
                                <span>{{ $feedbacks->count() }} Reviews</span>
                            </div>
                            <div class="product-price-discount"><span>${{ $stay->price }}</span>
                                {{-- <span class="line-through">$29.00</span> --}}
                            </div>
                        </div>

                        <p>
                            City: {{ $stay->city }}
                        </p>
                        <p>
                            Street Address: {{ $stay->streetaddress }}
                        </p>
                        <p>
                            Numberof Bedrooms: {{ $stay->numberofbedrooms }}
                        </p>
                        <p>
                            Maxnumof Guests: {{ $stay->maxnumofguests }}
                        </p>



                        <form action="{{ route('booknowstay') }}" method="POST">
                            @csrf

                            <input type="hidden" id="stay_id" name="stay_id" class="form-control"
                                value="{{ $stay->id }}" required>

                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" required>
                            </div>
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" required>
                            </div>
                            @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror




                            <div class="product-count">
                                <button type="submit" class="round-black-btn">Book Now</button>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
            <div class="product-info-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab"
                            aria-controls="description" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                            aria-controls="review" aria-selected="false">Reviews ({{ $feedbacks->count() }})</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                        aria-labelledby="description-tab">
                        {{ $stay->description }}
                    </div>
                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <div class="review-heading mb-4">
                            <h3>Reviews</h3>
                        </div>

                        <!-- Check if there are reviews -->
                        @if ($feedbacks->isEmpty())
                            <p class="mb-4">There are no reviews yet.</p>
                        @else
                            <!-- Loop through each feedback and display it -->
                            @foreach ($feedbacks as $feedback)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <!-- User avatar or initials -->
                                            <div class="avatar mr-3">
                                                <img src="{{ asset('Frontend/images/Unknown_person.jpg') }}"
                                                    alt="User Avatar" class="rounded-circle" width="40"
                                                    height="40">
                                            </div>
                                            <div>
                                                <strong>{{ $feedback->user->name }}</strong>
                                                <small
                                                    class="text-muted">{{ $feedback->created_at->format('M d, Y') }}</small>
                                            </div>
                                        </div>
                                        <div class="rating mb-2">
                                            <!-- Display the rating as stars (1-5 scale) -->
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fas fa-star{{ $i <= $feedback->rating ? ' text-warning' : '' }}"></i>
                                            @endfor
                                        </div>
                                        <p class="card-text">{{ $feedback->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <!------ Include the above in your HEAD tag ---------->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center my-2">
                    <h4>Isotope filter magical layouts with Bootstrap 4</h4>
                </div>
            </div>
            <div class="portfolio-menu mt-2 mb-4">
                <ul>
                    <li class="btn btn-outline-dark active" data-filter="*">All</li>
                    <li class="btn btn-outline-dark" data-filter=".gts">Girls T-shirt</li>
                    <li class="btn btn-outline-dark" data-filter=".lap">Laptops</li>
                    <li class="btn btn-outline-dark text" data-filter=".selfie">selfie</li>
                </ul>
            </div>
            <div class="portfolio-item row">
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/stylish-young-woman-with-bags-taking-selfie_23-2147962203.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/stylish-young-woman-with-bags-taking-selfie_23-2147962203.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/pretty-girl-near-car_1157-16962.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/pretty-girl-near-car_1157-16962.jpg" alt="">
                    </a>
                </div>
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/blonde-tourist-taking-selfie_23-2147978899.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/blonde-tourist-taking-selfie_23-2147978899.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/cute-girls-oin-studio_1157-18211.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/cute-girls-oin-studio_1157-18211.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/stylish-pin-up-girls_1157-18451.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/stylish-pin-up-girls_1157-18451.jpg" alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/stylish-pin-up-girl_1157-18940.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/stylish-pin-up-girl_1157-18940.jpg" alt="">
                    </a>
                </div>
                <div class="item lap col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/digital-laptop-working-global-business-concept_53876-23438.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/digital-laptop-working-global-business-concept_53876-23438.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item lap col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-psd/set-digital-devices-screen-mockup_53876-76507.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-psd/set-digital-devices-screen-mockup_53876-76507.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/young-brunette-woman-with-sunglasses-urban-background_1139-893.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/young-brunette-woman-with-sunglasses-urban-background_1139-893.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item lap col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-psd/laptop-digital-device-screen-mockup_53876-76509.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-psd/laptop-digital-device-screen-mockup_53876-76509.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/young-woman-holding-pen-hand-thinking-while-writing-notebook_23-2148029424.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/young-woman-holding-pen-hand-thinking-while-writing-notebook_23-2148029424.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-psd/female-fashion-concept_23-2147643598.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-psd/female-fashion-concept_23-2147643598.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/girl-city_1157-16454.jpg" class="fancylight popup-btn"
                        data-fancybox-group="light">
                        <img class="img-fluid" src="https://image.freepik.com/free-photo/girl-city_1157-16454.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/elegant-lady-with-laptop_1157-16643.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/elegant-lady-with-laptop_1157-16643.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item lap col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-psd/laptop-mock-up-lateral-view_1310-199.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-psd/laptop-mock-up-lateral-view_1310-199.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/portrait-young-woman_1303-10071.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/portrait-young-woman_1303-10071.jpg" alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/beautiful-girl-near-wall_1157-16401.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/beautiful-girl-near-wall_1157-16401.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/woman-taking-photograph-her-boyfriend-enjoying-piggyback-ride-his-back_23-2147841613.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/woman-taking-photograph-her-boyfriend-enjoying-piggyback-ride-his-back_23-2147841613.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/girl-smiling-making-auto-photo-with-her-friends-around_1139-593.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/girl-smiling-making-auto-photo-with-her-friends-around_1139-593.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/multiracial-group-young-people-taking-selfie_1139-1032.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/multiracial-group-young-people-taking-selfie_1139-1032.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item lap col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/laptop-wooden-table_53876-20635.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/laptop-wooden-table_53876-20635.jpg" alt="">
                    </a>
                </div>
                <div class="item lap col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/business-woman-working-laptop_1388-67.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/business-woman-working-laptop_1388-67.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item lap col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-psd/group-people-holding-laptop-mockup-charity_23-2148069565.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-psd/group-people-holding-laptop-mockup-charity_23-2148069565.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/portrait-young-cheerful-woman-headphones-sitting-stairs_1262-17488.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/portrait-young-cheerful-woman-headphones-sitting-stairs_1262-17488.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/celebration-concept-close-up-portrait-happy-young-beautiful-african-woman-black-t-shirt-smiling-with-colorful-party-balloon-yellow-pastel-studio-background_1258-934.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/celebration-concept-close-up-portrait-happy-young-beautiful-african-woman-black-t-shirt-smiling-with-colorful-party-balloon-yellow-pastel-studio-background_1258-934.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item gts col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/pretty-woman-showing-arm-muscles_23-2148056021.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/pretty-woman-showing-arm-muscles_23-2148056021.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item lap col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/blank-colorful-adhesive-notes-against-wooden-wall-with-office-stationeries-laptop_23-2148052717.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/blank-colorful-adhesive-notes-against-wooden-wall-with-office-stationeries-laptop_23-2148052717.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item lap col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/happy-woman-having-video-call-using-laptop-office_23-2148056211.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/happy-woman-having-video-call-using-laptop-office_23-2148056211.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item lap col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-psd/laptop-mockup-table-with-plants_23-2147955548.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-psd/laptop-mockup-table-with-plants_23-2147955548.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item lap col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/blank-colorful-adhesive-notes-against-wooden-wall-with-office-stationeries-laptop_23-2148052717.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/blank-colorful-adhesive-notes-against-wooden-wall-with-office-stationeries-laptop_23-2148052717.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item lap col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-psd/woman-using-laptop-smartphone_53876-76350.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-psd/woman-using-laptop-smartphone_53876-76350.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/attractive-young-woman-with-curly-hair-takes-selfie-posing-looking-camera_8353-6636.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/attractive-young-woman-with-curly-hair-takes-selfie-posing-looking-camera_8353-6636.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/young-couple-taking-selfie-mobile-phone-against-blue-background_23-2148056292.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/young-couple-taking-selfie-mobile-phone-against-blue-background_23-2148056292.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item lap col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/close-up-blonde-woman-sitting-sofa-using-laptop-with-blank-white-screen_23-2148028738.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/close-up-blonde-woman-sitting-sofa-using-laptop-with-blank-white-screen_23-2148028738.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/group-happy-friends-taking-selfie-cellphone_23-2147859575.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/group-happy-friends-taking-selfie-cellphone_23-2147859575.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/joyful-pretty-girl-with-curly-hair-takes-selfie-mobile-phone_8353-6635.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/joyful-pretty-girl-with-curly-hair-takes-selfie-mobile-phone_8353-6635.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/attractive-young-woman-with-curly-hair-takes-selfie-posing-looking-camera_8353-6636.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/attractive-young-woman-with-curly-hair-takes-selfie-posing-looking-camera_8353-6636.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/multiracial-group-young-people-taking-selfie_1139-1032.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/multiracial-group-young-people-taking-selfie_1139-1032.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item selfie col-lg-3 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/two-smiling-girls-take-selfie-their-phones-posing-with-lollipops_8353-5600.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/two-smiling-girls-take-selfie-their-phones-posing-with-lollipops_8353-5600.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/female-friends-sitting-car-hood-taking-self-portrait_23-2147855623.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/female-friends-sitting-car-hood-taking-self-portrait_23-2147855623.jpg"
                            alt="">
                    </a>
                </div>
                <div class="item selfie col-lg-3 col-md-4 col-6 col-sm">
                    <a href="https://image.freepik.com/free-photo/two-smiling-girls-take-selfie-their-phones-posing-with-lollipops_8353-5600.jpg"
                        class="fancylight popup-btn" data-fancybox-group="light">
                        <img class="img-fluid"
                            src="https://image.freepik.com/free-photo/two-smiling-girls-take-selfie-their-phones-posing-with-lollipops_8353-5600.jpg"
                            alt="">
                    </a>
                </div>
            </div>
        </div>



    </div>

    </div>
    </div>

    <script src="{{ asset('Frontend/js/details.js') }}"></script>
@endsection
