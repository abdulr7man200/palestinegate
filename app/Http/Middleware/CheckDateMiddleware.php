<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cars;
use App\Models\Rooms;
use App\Models\Stays;
use App\Models\Booking;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Handle cars
        $carBookings = Booking::whereNotNull('car_id')
            ->select('car_id', Booking::raw('MAX(end_date) as latest_end_date'))
            ->groupBy('car_id')
            ->get();

        foreach ($carBookings as $carBooking) {
            if ($carBooking->latest_end_date <= now()) {
                $car = Cars::find($carBooking->car_id); // Fetch the car directly
                if ($car) {
                    $car->rented = false;
                    $car->save();
                }
            }
        }

        // Handle stays
        $stayBookings = Booking::whereNotNull('stay_id')
            ->select('stay_id', Booking::raw('MAX(end_date) as latest_end_date'))
            ->groupBy('stay_id')
            ->get();


        foreach ($stayBookings as $stayBooking) {
            if ($stayBooking->latest_end_date <= now()) {
                $stay = Stays::find($stayBooking->stay_id); // Fetch the stay directly
                if ($stay) {
                    $stay->availability = true;
                    $stay->save();
                }
            }
        }

        // Handle rooms
        $roomBookings = Booking::whereNotNull('room_id')
            ->select('room_id', Booking::raw('MAX(end_date) as latest_end_date'))
            ->groupBy('room_id')
            ->get();

        foreach ($roomBookings as $roomBooking) {
            if ($roomBooking->latest_end_date <= now()) {
                $room = Rooms::find($roomBooking->room_id); // Fetch the room directly
                if ($room) {
                    $room->availability = true;
                    $room->save();
                }
            }
        }

        return $next($request);
    }


}
