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

                            <th scope="col">Add Feedback</th>
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
                            <td><span class="badge bg-success">{{ $booking->status }}</span></td>

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
                                <td></td> <!-- Empty TD for Stay-related data -->
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
                                <button class="btn btn-sm btn-primary add-feedback" data-toggle="modal" data-target="#feedbackModal" data-id="{{ $booking->id }}">
                                    Add Feedback
                                </button>
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
                <form id="feedbackForm">
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

<script>
    $(document).ready(function () {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    var bookingId = $(this).data('id');

    // AJAX form submission for feedback
    $('#feedbackForm').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            url: "/addfeedback/" + bookingId, // Direct URL with bookingId
            method: "POST",
            data: formData,
            success: function (response) {
                $('#feedback-message').html('<div class="alert alert-success">' + response.success + '</div>');
                $('#feedbackModal').modal('hide');
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



@endsection


