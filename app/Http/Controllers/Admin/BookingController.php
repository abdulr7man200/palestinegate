<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Rooms;
use App\Models\Cars;
use App\Models\Stays;
use App\DataTables\BookingsDataTable;

class BookingController extends Controller
{
    public function index(BookingsDataTable $dataTable)
    {
        return $dataTable->render('admin.booking.index');
    }

    public function edit($id)
    {
        $data = Booking::find($id);

        if (!$data) {
            return response()->json(['error' => 'not found.'], 404);
        }

        return response()->json([
            'data' => $data,
        ]);
    }

    public function update($id)
    {
        request()->validate([
            'status' => ['required', 'in:pending,confirmed,canceled'],
        ]);

        $user = auth()->user();

        $data = Booking::find($id);

        if (!$data) {
            return response()->json(['error' => 'not found.'], 404);
        }

        $data->status = request('status');
        $data->save();

        if($data->status == 'canceled'){
            if($data->room_id){
                $room = Rooms::where('id', $data->room_id)->first();
                $room->availability = true;
                $room->save();
            }

            if($data->car_id){
                $car = Cars::where('id', $data->car_id)->first();
                $car->rented = false;
                $car->save();
            }

            if($data->stay_id){
                $stay = Stays::where('id', $data->stay_id)->first();
                $stay->availability = true;
                $stay->save();
            }
        }



        return response()->json(['success' => 'Successfully Updated']);
    }

    public function destroy($id)
    {
        $data = Booking::find($id);
        if (!$data) {
            return response()->json(['error' => 'not found.'], 404);
        }
        $data->delete();

        return response()->json(['success' => 'Successfully Deleted']);
    }
}
