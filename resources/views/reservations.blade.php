@extends('layouts.app')

@section('content')

<style>
.star-rating {
    display: flex;
    justify-content: center;
    cursor: pointer;
}

.star {
    font-size: 40px;
    color: #ddd;
    padding: 5px;
    transition: color 0.3s ease;
}

.star:hover,
.star.hovered {
    color: gold;
}

.star.selected {
    color: gold;
}


</style>
<section class="site-hero inner-page overlay" style="background-image: url('Frontend/images/jerusalem.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
            <div class="col-md-10 text-center" data-aos="fade">
                <h1 class="heading mb-3">My Reservations</h1>
            </div>
        </div>
    </div>

    <a class="mouse smoothscroll" href="#next">
        <div class="mouse-icon">
            <span class="mouse-wheel"></span>
        </div>
    </a>
</section>


<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary bg-gradient text-white">
            <h3 class="mb-0">Reservations History</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle" aria-label="Order history table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Type</th>
                            <th scope="col">Price</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Status</th>

                            <!-- Check if any booking has stay_id or car_id -->
                            @php
                                $hasStay = $bookings->whereNotNull('stay_id')->isNotEmpty();
                                $hasCar = $bookings->whereNotNull('car_id')->isNotEmpty();
                            @endphp

                            @if($hasStay)
                                <th scope="col">Stay Name</th>
                                <th scope="col">Stay Type</th>
                                @if($bookings->whereNotNull('room_id')->isNotEmpty())
                                    <th scope="col">Room Number</th>
                                @endif
                            @endif

                            @if($hasCar)
                                <th scope="col">Car Type</th>
                                <th scope="col">Car Model</th>
                                <th scope="col">Car Year</th>
                                <th scope="col">Car Location</th>
                            @endif

                            <th scope="col">Action</th>
                            {{-- <th scope="col">Confirmation</th> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($bookings as $booking)
                        <tr>
                            <td>#{{ $booking->id }}</td>
                            <td>{{ $booking->type }}</td>
                            <td>{{ $booking->price }}</td>
                            <td>{{ $booking->start_date }}</td>
                            <td>{{ $booking->end_date }}</td>
                            <td>
                                @if ($booking->status == 'pending')
                                    <span class="badge bg-warning">{{ ucfirst($booking->status) }}</span>
                                @elseif ($booking->status == 'paid')
                                    <span class="badge bg-success">{{ ucfirst($booking->status) }}</span>
                                @elseif ($booking->status == 'confirmed')
                                    <span class="badge bg-primary">{{ ucfirst($booking->status) }}</span>
                                @elseif ($booking->status == 'canceled')
                                    <span class="badge bg-danger">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </td>

                            <!-- Conditionally add data based on the booking type -->
                            @if ($booking->stay_id)
                                <td>#{{ $booking->stay->name }}</td>
                                <td>#{{ $booking->stay->type }}</td>
                                @if ($booking->room_id)
                                    <td>#{{ $booking->room->room_number }}</td>
                                @else
                                    <td></td> <!-- Empty TD to maintain the structure -->
                                @endif
                                <!-- Add empty td for car columns to keep alignment -->
                                @if($hasCar)
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                @endif
                            @elseif ($booking->car_id)
                                {{-- <td></td>  --}}
                                <td></td>
                                @if ($booking->room_id)
                                    <td></td>
                                @endif
                                <td></td>
                                <td>{{ $booking->car->type }}</td>
                                <td>{{ $booking->car->model }}</td>
                                <td>{{ $booking->car->year }}</td>
                                <td>{{ $booking->car->location }}</td>
                            @endif

                            <td>
                            @if ($booking->status == 'confirmed')
                            @if ($booking->feedback)
                            <span class="badge bg-success">Feedback Received</span>
                            @else
                                <button class="btn btn-sm btn-primary add-feedback" data-toggle="modal" data-target="#feedbackModal" data-id="{{ $booking->id }}">
                                    Add Feedback
                                </button>
                            @endif

                            @else

                            @if ($booking->status == 'pending')
                            <a class="btn btn-sm btn-primary" href="{{ route('bookingbyid', $booking->id) }}" >Continue Bookings</a>

                            @else
                            @if ($booking->status != 'canceled')
                            <span class="badge bg-primary">Wait Confirmation</span>
                            @endif

                            @endif

                            @endif


                            @if ($booking->status == 'paid' || $booking->status == 'confirmed')
                            <form id="cancel-booking-form-{{ $booking->id }}" action="{{ route('cancelbooking', $booking->id) }}" method="post">
                                @csrf
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmCancelBooking({{ $booking->id }})">Cancel</button>
                            </form>

                            <script>
                                function confirmCancelBooking(bookingId) {
                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: "You won't be able to revert this action!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#d33',
                                        cancelButtonColor: '#3085d6',
                                        confirmButtonText: 'Yes, cancel it!'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            document.getElementById(`cancel-booking-form-${bookingId}`).submit();
                                        }
                                    });
                                }
                            </script>

                            @endif



                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No bookings available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- Single Modal for All Feedbacks -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel">Add Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="feedbackForm" method="POST" action="">
                    @csrf
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <div class="star-rating" id="rating">
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                        </div>
                        <input type="hidden" id="rating-value" name="rating" value="">
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Feedback</button>
                </form>
                <div id="feedback-message" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on("click", ".add-feedback", function () {
    const bookingId = $(this).data("id");
    $('#feedbackForm').attr('action', '/addfeedback/' + bookingId);

    console.log(bookingId);

});

    // AJAX form submission for feedback
    $('#feedbackForm').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        const form = $(this);
        const url = form.attr('action'); // Get the dynamically updated action URL


        $.ajax({
            url: url, // Direct URL with bookingId
            method: "POST",
            data: form.serialize(),
            success: function (response) {
                $('#feedback-message').html('<div class="alert alert-success">' + response.success + '</div>');
                $('#feedbackModal').modal('hide');
                location.reload();
            },
            error: function (xhr) {
                var errorMessages = xhr.responseJSON.errors;
                var errorText = '';
                $.each(errorMessages, function (key, value) {
                    errorText += value[0] + '<br>';
                });
                $('#feedback-message').html('<div class="alert alert-danger">' + errorText + '</div>');
            }
        });
    });

    });


    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('.star-rating .star');
        const ratingValueInput = document.getElementById('rating-value');

        stars.forEach(star => {
            star.addEventListener('mouseover', function () {
                resetStars();
                const value = parseInt(star.getAttribute('data-value'));
                highlightStars(value);
            });

            star.addEventListener('click', function () {
                const value = parseInt(star.getAttribute('data-value'));
                setRating(value);
            });

            star.addEventListener('mouseout', function () {
                resetStars();
                const selectedRating = parseInt(ratingValueInput.value);
                if (selectedRating) {
                    highlightStars(selectedRating);
                }
            });
        });

        function highlightStars(value) {
            stars.forEach(star => {
                if (parseInt(star.getAttribute('data-value')) <= value) {
                    star.classList.add('hovered');
                }
            });
        }

        function setRating(value) {
            ratingValueInput.value = value;
            stars.forEach(star => {
                if (parseInt(star.getAttribute('data-value')) <= value) {
                    star.classList.add('selected');
                } else {
                    star.classList.remove('selected');
                }
            });
        }

        function resetStars() {
            stars.forEach(star => {
                star.classList.remove('hovered');
            });
        }
    });

    </script>

@endpush


@endsection


