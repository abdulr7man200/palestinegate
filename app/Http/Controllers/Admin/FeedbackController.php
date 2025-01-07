<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\DataTables\FeedbackDataTable;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(FeedbackDataTable $dataTable)
    {
        return $dataTable->render('admin.feedback.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        request()->validate([
            'user_id' => ['required', 'exists:users,id'],
            'booking_id' => ['required', 'exists:bookings,id'],
            'comment' => ['required', 'string'],
            'rating' => ['required', 'in:1,2,3,4,5'],
        ]);

        $data = new Feedback();
        $data->user_id = request('user_id');
        $data->booking_id = request('booking_id');
        $data->comment = request('comment');
        $data->rating = request('rating');
        $data->save();

        return response()->json(['success' => 'Successfully Created']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Feedback::find($id);

        if (!$data) {
            return response()->json(['error' => 'Not found.'], 404);
        }

        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        request()->validate([
            'user_id' => ['required', 'exists:users,id'],
            'booking_id' => ['required', 'exists:bookings,id'],
            'comment' => ['required', 'string'],
            'rating' => ['required', 'in:1,2,3,4,5'],
        ]);

        $data = Feedback::find($id);
        if (!$data) {
            return response()->json(['error' => 'Not found.'], 404);
        }

        $data->user_id = request('user_id');
        $data->booking_id = request('booking_id');
        $data->comment = request('comment');
        $data->rating = request('rating');
        $data->save();

        return response()->json(['success' => 'Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Feedback::find($id);
        if (!$data) {
            return response()->json(['error' => 'Not found.'], 404);
        }
        $data->delete();

        return response()->json(['success' => 'Successfully Deleted']);
    }
}
