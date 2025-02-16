<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Cars;
use App\Models\User;
use App\Models\Rooms;
use App\Models\Stays;
use Telegram\Bot\Api;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Mail\BookingConfirmation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $totalBookings = Booking::count();
        $totalUsers = User::count();
        $totalPrice = Booking::where('store_id', $user->id)
        ->sum('price');
        $totalCars = $user->hasRole('admin') ? Cars::count() : Cars::where('user_id', $user->id)->count();
        $totalStays = $user->hasRole('admin') ? Stays::count() : Stays::where('user_id', $user->id)->count();
        return view('admin.dashboard',compact('totalBookings', 'totalUsers', 'totalPrice', 'totalCars', 'totalStays'));
    }

    public function contactus()
    {
        return view('contactus');
    }
    public function aboutus()
    {
        return view('aboutus');
    }
    public function welcome()
    {
        $cars = Cars::with(['carPics'])
            ->take(10)
            ->where('rented', false)
            ->inRandomOrder()
            ->get();
        $stays = Stays::with(['staysPics'])
            ->take(10)
            ->inRandomOrder()
            ->get();

        $carsrec = Cars::with(['carPics'])
            ->where('is_recommended', true) // Filter recommended cars
            ->take(10)
            ->where('rented', false)
            ->inRandomOrder()
            ->get();

        $staysrec = Stays::with(['staysPics'])
            ->where('is_recommended', true) // Filter recommended stays
            ->take(10)
            ->inRandomOrder()
            ->get();

        $recommendedItems = $carsrec->concat($staysrec);


        return view('welcome', compact('cars', 'stays', 'recommendedItems'));
    }

    public function Services()
    {
        $cars = Cars::with(['carPics'])
            ->take(10)
            ->where('rented', false)

            ->inRandomOrder()
            ->get();
        $stays = Stays::with(['staysPics'])
            ->take(10)
            ->inRandomOrder()
            ->get();
        return view('Services', compact('cars', 'stays'));
    }
    public function stays(Request $request)
    {
        $stays = Stays::with(['staysPics']);

        // Apply filters if the parameters are present
        if ($request->has('type') && $request->type != '') {
            $stays = $stays->where('type', $request->type);
        }

        if ($request->has('city') && $request->city != '') {
            $stays = $stays->where('city', $request->city);
        }

        if ($request->has('price') && $request->price != '') {
            // Filter by price range
            if ($request->price == 'lowest') {
                $stays = $stays->orderBy('price', 'asc');
            } elseif ($request->price == 'highest') {
                $stays = $stays->orderBy('price', 'desc');
            }
        }

        if ($request->has('numberofbedrooms') && $request->numberofbedrooms != '') {
            if ($request->numberofbedrooms == '4') {
                $stays = $stays->where('numberofbedrooms', '>=', 4);
            } else {
                $stays = $stays->where('numberofbedrooms', $request->numberofbedrooms);
            }
        }


        // Paginate the results (16 items per page)
        $stays = $stays->paginate(16);

        return view('stays', compact('stays'));
    }


    public function cars(Request $request)
    {
        // Query to fetch cars with their associated pictures
        $cars = Cars::with(['carPics'])->where('rented', false);

        // Apply filters if the parameters are present
        if ($request->filled('type')) {
            $cars->where('type', 'like', '%' . $request->type . '%');
        }

        if ($request->has('location') && $request->location != '') {
            $cars = $cars->where('location', $request->location);
        }

        if ($request->has('price') && $request->price != '') {
            // Filter by price range
            if ($request->price == 'lowest') {
                $cars = $cars->orderBy('price_per_day', 'asc');
            } elseif ($request->price == 'highest') {
                $cars = $cars->orderBy('price_per_day', 'desc');
            }
        }

        if ($request->filled('year')) {
            $cars->where('year', $request->year);
        }


        // Paginate the results (16 items per page)
        $cars = $cars->paginate(16);

        return view('cars', compact('cars'));
    }



    public function cardetails($id)
    {
        $car = Cars::with('carPics')
        ->where('rented', false)
        ->find($id);

        if(!$car) {
            return redirect()->route('dashboard')->with('error', 'Car not found.');
        }

        $feedbacks = $car->feedbacks;  // Access the feedbacks


        // Calculate the average rating of the feedbacks
        $averageRating = $feedbacks->avg('rating'); // Calculate average rating

        // If no feedbacks exist, set default average rating to 0
        if ($averageRating === null) {
            $averageRating = 0;
        }


        return view('cardetails', compact('car', 'feedbacks', 'averageRating'));
    }

    public function booknow(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ]);


        $car = Cars::find($request->car_id);

        // Ensure the car exists
        if (!$car) {
            return redirect()->route('dashboard')->with('error', 'Car not found.');
        }

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $days = $startDate->diffInDays($endDate);

        $price = $car->price_per_day * $days;

        $booking = new Booking;
        $booking->car_id = $car->id;
        $booking->user_id = auth()->user()->id;
        $booking->store_id = $car->user->id;
        $booking->type = 'car';
        $booking->status = 'pending';
        $booking->start_date = $startDate;
        $booking->end_date = $endDate;
        $booking->price = $price;
        $booking->save();

        return redirect()->route('bookingbyid', $booking->id)->with('success', 'Your booking request has been sent successfully.');
    }

    public function booknowstay(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ]);


        $stay = Stays::find($request->stay_id);

        // Ensure the car exists
        if (!$stay) {
            return redirect()->route('dashboard')->with('error', 'Car not found.');
        }

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $days = $startDate->diffInDays($endDate);

        $price = $stay->price * $days;


        $booking = new Booking;
        $booking->stay_id = $stay->id;
        $booking->user_id = auth()->user()->id;
        $booking->store_id = $stay->user->id;
        $booking->type = 'stay';
        $booking->status = 'pending';
        $booking->start_date = $startDate;
        $booking->end_date = $endDate;
        $booking->price = $price;
        $booking->save();

        return redirect()->route('bookingbyid', $booking->id)->with('success', 'Your booking request has been sent successfully.');
    }

    public function staydetails($id){
        $stay = Stays::with('staysPics', 'Rooms.room_pics')->find($id);
        if(!$stay){
            return redirect()->route('dashboard')->with('error', 'Stay not found.');
        }

        $feedbacks = $stay->feedbacks;  // Access the feedbacks


        // Calculate the average rating of the feedbacks
        $averageRating = $feedbacks->avg('rating'); // Calculate average rating

        // If no feedbacks exist, set default average rating to 0
        if ($averageRating === null) {
            $averageRating = 0;
        }

        return view('staydetails', compact('stay', 'feedbacks', 'averageRating'));
    }

    public function bookingbyid($id)
    {
        $booking = Booking::where('user_id', auth()->user()->id)
            ->with(['car.carPics', 'store', 'user', 'stay.staysPics'])
            ->where('id', $id)
            ->first();

        if (!$booking) {
            return redirect()->route('welcome')->with('error', 'Booking not found or does not belong to you.');
        }

        if ($booking->status!= 'pending') {
            return redirect()->route('welcome')->with('error', 'Booking cannot be processed at this time.');
        }


        // Check if either 'stay_id' or 'car_id' exists
        $stay = $booking->stay_id ? $booking->stay : null;
        $car = $booking->car_id ? $booking->car : null;
        $room = $booking->room_id ? $booking->room : null;

        return view('Booking', compact('booking', 'stay', 'car', 'room'));
    }

    public function payment(Request $request)
    {
        // Validate the form fields
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|max:20',
            'name' => 'required',
            'note' => 'nullable',
            'payment_method' => 'required|in:new,existing',
        ]);

        $booking = Booking::find($request->booking_id);

        // If booking doesn't exist, redirect with an error
        if (!$booking) {
            return redirect()->route('bookingbyid', $booking->id)->with('error', 'Booking not found.');
        }

        // Proceed to update booking details
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->name = $request->name;
        $booking->note = $request->note;

        // Handle the payment method
        if ($request->payment_method == 'new') {
            // Validate new payment method details
            $request->validate([
                'cardholder_name' => 'required|string|max:255',
                'card_number' => 'required|numeric|digits:16|unique:payments,card_number',
                'expiry_date' => 'required|date_format:m/y',
                'cvv' => 'required|numeric|digits:3',
            ]);

            // Create a new payment record
            $payment = new Payment();
            $payment->user_id = auth()->id();
            $payment->name = $request->cardholder_name;
            $payment->card_number = Crypt::encryptString($request->card_number);
            $payment->expiry_date = $request->expiry_date;
            $payment->cvv = Crypt::encryptString($request->cvv);
            $payment->save();

            // Associate payment with the booking
            $booking->payment_id = $payment->id;
        } else {
            // Use an existing payment method
            $payment = Payment::where('user_id', auth()->id())
                              ->where('id', $request->payment_id)
                              ->firstOrFail();

            $booking->payment_id = $payment->id;
        }

        // Update booking status and save
        $booking->status = 'paid';
        $booking->save();

        // Handle the car, room, or stay availability and send messages
        $telegram = new Api();
        $chatId = '-1002295011652'; // Replace with the recipient's chat ID
        $message = "Booking Confirmation\n\n"
            . "Hello! Your payment has been successfully processed and your booking is confirmed.\n\n"
            . "Booking Details:\n"
            . "User: " . auth()->user()->name . "\n";

        // Handle car booking
        if ($booking->car_id) {
            $car = Cars::where('id', $booking->car_id)->first();
            $car->rented = true;
            $car->save();

            $message .= "Car Owner: " . $booking->store->name . "\n"
                . "Car ID: " . $car->id . "\n"
                . "Car Model: " . $car->model . "\n";
        }

        // Handle room booking
        if ($booking->room_id) {
            $room = Rooms::where('id', $booking->room_id)->first();
            $room->availability = false;
            $room->save();

            $message .= "Stay Owner: " . $booking->store->name . "\n"
                . "Room Number: " . $room->room_number . "\n";
        }

        // Handle stay booking
        if ($booking->stay_id) {
            $stay = Stays::where('id', $booking->stay_id)->first();
            $stay->availability = false;
            $stay->save();

            $message .= "Stay Name: " . $stay->name . "\n"
                . "Stay Owner: " . $booking->store->name . "\n";
        }

        // Add payment status to the message
        $message .= "Payment Status: Paid\n";

        // Send Telegram message
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message
        ]);

        // Send email to the user
        Mail::to($booking->email)->send(new BookingConfirmation($booking));

        // Send email to the store
        Mail::to($booking->store->email)->send(new BookingConfirmation($booking, true));

        // Redirect to dashboard with success message
        return redirect()->route('reservations')->with('success', 'Your stay booking has been reserved successfully.');
    }



    public function roomdetails($id){
        $room = Rooms::with('stay.staysPics', 'room_pics')->find($id);
        if(!$room){
            return redirect()->route('welcome')->with('error', 'Room not found.');
        }

        $feedbacks = $room->feedbacks;  // Access the feedbacks


        // Calculate the average rating of the feedbacks
        $averageRating = $feedbacks->avg('rating'); // Calculate average rating

        // If no feedbacks exist, set default average rating to 0
        if ($averageRating === null) {
            $averageRating = 0;
        }

        return view('roomdetails', compact('room', 'feedbacks', 'averageRating'));
    }

    public function rooms(Request $request, $id)
    {
        // Query to fetch cars with their associated pictures
        $rooms = Rooms::with(['room_pics'])->where('availability', true)
        ->where('stay_id', $id);


        if ($request->has('pricepernight') && $request->pricepernight != '') {
            if ($request->pricepernight == 'lowest') {
                $rooms = $rooms->orderBy('pricepernight', 'asc');
            } elseif ($request->pricepernight == 'highest') {
                $rooms = $rooms->orderBy('pricepernight', 'desc');
            }
        }


        if ($request->has('numberofbedrooms') && $request->numberofbedrooms != '') {
            if ($request->numberofbedrooms == '4') {
                $rooms = $rooms->where('beds', '>=', 4);
            } else {
                $rooms = $rooms->where('beds', $request->numberofbedrooms);
            }
        }

            // Checkboxes for additional features (AC, Wi-Fi, TV)
        if ($request->has('has_ac') && $request->has_ac == 'on') {
            $rooms = $rooms->where('has_ac', true);
        }
        if ($request->has('has_wifi') && $request->has_wifi == 'on') {
            $rooms = $rooms->where('has_wifi', true);
        }
        if ($request->has('has_tv') && $request->has_tv == 'on') {
            $rooms = $rooms->where('has_tv', true);
        }

        $rooms = $rooms->paginate(16);

        return view('rooms', compact('rooms'));
    }


    public function booknowroom(Request $request)
    {
        $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ]);


        $room = Rooms::find($request->room_id);

        // Ensure the car exists
        if (!$room) {
            return redirect()->route('dashboard')->with('error', 'Room not found.');
        }

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

        $days = $startDate->diffInDays($endDate);

        $days = $startDate->diffInDays($endDate);

        $price = $room->pricepernight * $days;


        $booking = new Booking;
        $booking->stay_id = $room->stay->id;
        $booking->room_id = $room->id;
        $booking->user_id = auth()->user()->id;
        $booking->store_id = $room->user->id;
        $booking->type = 'stay';
        $booking->status = 'pending';
        $booking->start_date = $startDate;
        $booking->end_date = $endDate;
        $booking->price = $price;
        $booking->save();

        return redirect()->route('bookingbyid', $booking->id)->with('success', 'Your booking request has been sent successfully.');
    }


    public function reservations(){
        $bookings = Booking::where('user_id', auth()->user()->id)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('reservations', compact('bookings'));
    }

    public function addfeedback(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:100000',
        ]);

        try {
            // Ensure the booking exists
            $booking = Booking::findOrFail($id);

                  // Check if feedback already exists
            $existingFeedback = Feedback::where('booking_id', $booking->id)
            ->first();

            if ($existingFeedback) {
                return response()->json(['error' => 'You have already submitted feedback for this booking.'], 400);
            }

            // Create new feedback entry
            $feedback = new Feedback();
            $feedback->user_id = auth()->user()->id;
            $feedback->booking_id = $booking->id;
            $feedback->rating = $request->rating;
            $feedback->comment = $request->comment;
            $feedback->save();

            return response()->json(['success' => 'Your feedback has been submitted successfully.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Booking not found.'], 404);
        } catch (Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }


    public function cancelbooking($id){
        $user = auth()->user();

        $booking = Booking::where('user_id', $user->id)
        ->find($id);


        if(!$booking){
            return redirect()->route('welcome')->with('error', 'Booking not found.');
        }


        if($booking->status == 'paid' || $booking->status == 'confirmed' ){

            $booking->status = 'canceled';
            $booking->save();
            if($booking->car_id){
                $car = Cars::find($booking->car_id);
                $car->rented = false;
                $car->save();
            }elseif($booking->stay_id){
                $stay = Stays::find($booking->stay_id);
                $stay->availability = true;
                $stay->save();
            }else{
                $room = Rooms::find($booking->room_id);
                $room->availability = true;
                $room->save();
            }

            return redirect()->route('reservations')->with('success', 'Your booking has been cancelled successfully.');

        }




        return redirect()->route('reservations')->with('error', 'You can only cancel a booking that is in a confirmed or paid state.');

    }
}
