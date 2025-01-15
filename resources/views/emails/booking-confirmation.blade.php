<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Notification</title>
</head>
<body>
    @if ($user)
        <h1>Booking Confirmation</h1>
        <p>Dear {{ $user->name }},</p>

        <p>Your payment has been successfully processed and your booking is confirmed. Below are your booking details:</p>

        <h3>Booking Details:</h3>
        <p><strong>User:</strong> {{ $user->name }}</p>

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

        <p>Thank you for booking with us. We hope you have a wonderful experience!</p>

        <p>Best regards,</p>
        <p>Your Booking Team</p>
    @endif


</body>
</html>
