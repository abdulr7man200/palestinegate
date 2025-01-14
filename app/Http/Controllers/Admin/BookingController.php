<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
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
 