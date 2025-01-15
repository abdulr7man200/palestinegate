
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Notification</title>
</head>
<body>

<h1>New Booking Notification</h1>
<p>Dear {{ $booking->store->name }},</p>

<p>A new booking has been made for your property. Below are the booking details:</p>

<h3>Booking Details:</h3>
<p><strong>Customer Name:</strong> {{ $user->name }}</p>
<p><strong>Customer Email:</strong> {{ $user->email }}</p>
<p><strong>Customer Phone:</strong> {{ $user->phone }}</p>

@if($booking->car_id)
    <p><strong>Car Model:</strong> {{ $car->model }}</p>
    <p><strong>Car ID:</strong> {{ $car->id }}</p>
@endif

@if($booking->room_id)
    <p><strong>Room Number:</strong> {{ $room->room_number }}</p>
@endif

@if($booking->stay_id)
    <p><strong>Stay Name:</strong> {{ $stay->name }}</p>
@endif

<p><strong>Payment Status:</strong> Paid</p>

<p>Your property has been successfully foreclosed on Please go to the website and confirm the booking for the customer</p>

<p>Thank you for partnering with us. We look forward to continuing to work together!</p>

<p>Best regards,</p>
<p>Your Booking Team</p>
</body>
</html>
