@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('Frontend/css/details.css') }}">

    <section class="site-hero inner-page overlay" style="background-image: url('{{ url('storage/' . $room->banner) }}');"
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
                    <div class="slider-container">
                        <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                          @forelse ($room->room_pics as $image)
                            <div class="slider-item">
                              <a >
                                <img src="{{ asset('storage/' . $image->path) }}" alt="Stay Image" class="img-fluid" style="height: 500px;">
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
                            <div class="product-name">{{ $room->stay->name }}</div>
                            <p>
                                {{ $room->stay->type }}
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
                        <div class="review-heading mb-4">
                            <h3>Reviews</h3>
                        </div>

                        <!-- Check if there are reviews -->
                        @if($feedbacks->isEmpty())
                            <p class="mb-4">There are no reviews yet.</p>
                        @else
                            <!-- Loop through each feedback and display it -->
                            @foreach($feedbacks as $feedback)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-2">
                                            <!-- User avatar or initials -->
                                            <div class="avatar mr-3">
                                                <img src="{{ asset('Frontend/images/Unknown_person.jpg') }}" alt="User Avatar" class="rounded-circle" width="40" height="40">
                                            </div>
                                            <div>
                                                <strong>{{ $feedback->user->name }}</strong>
                                                <small class="text-muted">{{ $feedback->created_at->format('M d, Y') }}</small>
                                            </div>
                                        </div>
                                        <div class="rating mb-2">
                                            <!-- Display the rating as stars (1-5 scale) -->
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $feedback->rating ? ' text-warning' : '' }}"></i>
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
    </div>

    <script src="{{ asset('Frontend/js/details.js') }}"></script>
@endsection
