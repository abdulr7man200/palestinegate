@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('Frontend/css/details.css') }}">

    <section class="site-hero inner-page overlay" style="background-image: url('{{ url('Frontend/images/haram.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade">
                    <h1 class="heading mb-3">Contact Us</h1>
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
                <h2>Room Details</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div id="carImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($room->room_pics as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Car Image">
                                </div>
                            @endforeach
                        </div>

                        <!-- Left and Right Arrows (No Text) -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carImagesCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carImagesCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>

                        <!-- Image Counter Row with Black Text (No Background) -->
                        <div class="d-flex justify-content-center mt-2 text-black">
                            <span id="imageIndex" class="fw-bold">1</span> of <span
                                class="fw-bold">{{ $room->room_pics->count() }}</span>
                        </div>
                    </div>
                </div>




                <div class="col-md-6">
                    <div class="product-dtl">
                        <div class="product-info">
                            <div class="product-name">{{ $room->stay->name }}</div>
                            <p>
                                {{ $room->stay->type }}
                            </p>
                            <div class="reviews-counter">
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" checked />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" checked />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" checked />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                <span>3 Reviews</span>
                            </div>
                            <div class="product-price-discount"><span>${{ $room->pricepernight }}</span>
                                {{-- <span class="line-through">$29.00</span> --}}
                            </div>
                        </div>

                        <p>
                            Beds: {{ $room->beds }}
                        </p>
                        <p>
                            Room Number: {{ $room->room_number }}
                        </p>
                        <p>
                            Has Ac: {{ $room->has_ac }}
                        </p>
                        <p>
                            Has Wifi: {{ $room->has_wifi }}
                        </p>
                        <p>
                            Has TV: {{ $room->has_tv }}
                        </p>



                        <form action="{{ route('booknowroom') }}" method="POST">
                            @csrf

                            <input type="hidden" id="room_id" name="room_id" class="form-control"
                                value="{{ $room->id }}" required>

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
                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description"
                            role="tab" aria-controls="description" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab"
                            aria-controls="review" aria-selected="false">Reviews (0)</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                        aria-labelledby="description-tab">
                        {{ $room->stay->description }}
                    </div>
                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        <div class="review-heading">REVIEWS</div>
                        <p class="mb-20">There are no reviews yet.</p>

                    </div>
                </div>
            </div>


        </div>
    </div>

    <script src="{{ asset('Frontend/js/details.js') }}"></script>
@endsection
