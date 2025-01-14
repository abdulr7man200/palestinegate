<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\Booking;
use App\Models\Stays;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Telegram\Bot\Api;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
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
        return view('cardetails', compact('car'));
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

    public function staydetails($id){
        $stay = Stays::with('staysPics')->find($id);
        return view('staydetails', compact('stay'));
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

        return view('Booking', compact('booking', 'stay', 'car'));
    }


    public function payment(Request $request)
    {
        // Validate the form fields
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|max:15',
            'name' => 'required',
            'note' => 'required',
            'payment_method' => 'required|in:new,existing',
        ]);


        $booking = Booking::find($request->booking_id);

        // If booking doesn't exist, redirect with an error
        if (!$booking) {
            return redirect()->route('dashboard')->with('error', 'Booking not found.');
        }

        // Proceed to update booking details
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->name = $request->name;
        $booking->note = $request->note;

        if ($request->payment_method == 'new') {
            // Validate new payment method details
            $request->validate([
                'cardholder_name' => 'required|string|max:255',
                'card_number' => 'required|numeric|digits:16',
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

        if($booking->car_id){
            $car = Cars::where('id', $booking->car_id)->first();
            $car->rented = true;
            $car->save();

            $telegram = new Api();
            $chatId = '-1002295011652'; // Replace with the recipient's chat ID
            $message = "Booking Confirmation\n\n"
            . "Hello! Your payment has been successfully processed and your booking is confirmed.\n\n"
            . "Booking Details:\n"
            . "User: " . auth()->user()->name . "\n"
            . "Car ID: " . $car->id . "\n"
            . "Car Model: " . $car->model . "\n"
            . "Payment Status: Paid\n";
           }



        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message
        ]);

        // Redirect to dashboard with success message
        return redirect()->route('dashboard')->with('success', 'Your stay booking has been reserved successfully.');
    }


}
