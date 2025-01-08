<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\Stays;
use App\Models\RoomPics;
use App\DataTables\RoomDataTable;

class RoomController extends Controller
{
    public function index(RoomDataTable $dataTable)
    {
        $user = auth()->user();

        if($user->hasRole('admin')){
            $stays = Stays::where('type', 'hotels')
            ->get();
        }else{
            $stays = Stays::where('type', 'hotels')
            ->where('user_id', $user->id)
            ->get();
        }

        return $dataTable->render('admin.rooms.index', compact('stays'));
    }

    public function store()
    {
        request()->validate([
            'stay_id' => ['required', 'exists:stays,id'],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096'],
            'beds' => ['required', 'integer', 'min:1'], // Validates that the number of beds is a positive integer
            'pricepernight' => ['required', 'numeric', 'min:0'], // Validates that price per night is a positive number
            'room_number' => ['required', 'string', 'max:255'], // Validates that the room number is a string and not too long
            'availability' => ['required', 'boolean'], // Validates that availability is a boolean
            'has_ac' => ['required', 'boolean'], // Validates that AC availability is a boolean
            'has_wifi' => ['required', 'boolean'], // Validates that WiFi availability is a boolean
            'has_tv' => ['required', 'boolean'], // Validates that TV availability is a boolean
        ]);

        $user = auth()->user();

        $data = new Rooms;
        $data->user_id = $user->id;
        $data->stay_id = request()->stay_id;
        $data->beds = request()->beds;
        $data->pricepernight = request()->pricepernight;
        $data->room_number = request()->room_number;
        $data->availability = request()->availability;
        $data->has_ac = request()->has_ac;
        $data->has_wifi = request()->has_wifi;
        $data->has_tv = request()->has_tv;
        $data->save();

        if (request()->has('images')) {
            foreach (request()->file('images') as $image) {
                $path = $image->store('stay_images', 'public');

                $pic = new RoomPics;
                $pic->room_id = $data->id;
                $pic->path = $path; // Store the path
                $pic->save();
            }
        }

        return response()->json(['success' => 'Successfully Created']);
    }

    public function edit($id)
    {
        $data = Rooms::find($id);

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
            'stay_id' => ['required', 'exists:stays,id'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:4096'],
            'beds' => ['required', 'integer', 'min:1'], // Validates that the number of beds is a positive integer
            'pricepernight' => ['required', 'numeric', 'min:0'], // Validates that price per night is a positive number
            'room_number' => ['required', 'string', 'max:255'], // Validates that the room number is a string and not too long
            'availability' => ['required', 'boolean'], // Validates that availability is a boolean
            'has_ac' => ['required', 'boolean'], // Validates that AC availability is a boolean
            'has_wifi' => ['required', 'boolean'], // Validates that WiFi availability is a boolean
            'has_tv' => ['required', 'boolean'], // Validates that TV availability is a boolean
        ]);

        $user = auth()->user();

        $data = Rooms::find($id);
        if (!$data) {
            return response()->json(['error' => 'not found.'], 404);
        }
        $user = auth()->user();
        $data->user_id = $user->id;
        $data->stay_id = request()->stay_id;
        $data->beds = request()->beds;
        $data->pricepernight = request()->pricepernight;
        $data->room_number = request()->room_number;
        $data->availability = request()->availability;
        $data->has_ac = request()->has_ac;
        $data->has_wifi = request()->has_wifi;
        $data->has_tv = request()->has_tv;
        $data->save();

        // Upload and save new images
        if (request()->has('images')) {

            $oldImages = $data->room_pics; // Get related images
            foreach ($oldImages as $image) {
                $imagePath = storage_path('app/public/' . $image->path);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Remove the file from storage
                }
                $image->delete(); // Remove the database record
            }


            foreach (request()->file('images') as $image) {
                $path = $image->store('car_images', 'public');

                $pic = new RoomPics;
                $pic->room_id = $data->id;
                $pic->path = $path; // Store the path
                $pic->save();
            }
        }

        return response()->json(['success' => 'Successfully Updated']);
    }

    public function destroy($id)
    {
        $data = Rooms::find($id);
        if (!$data) {
            return response()->json(['error' => 'not found.'], 404);
        }
        $data->delete();

        return response()->json(['success' => 'Successfully Deleted']);
    }
}
