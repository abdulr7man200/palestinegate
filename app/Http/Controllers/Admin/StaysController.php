<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stays;
use App\Models\Rooms;
use App\Models\StaysPics;
use Illuminate\Http\Request;
use App\DataTables\StaysDataTable;
use App\Http\Controllers\Controller;

class StaysController extends Controller
{
    public function index(StaysDataTable $dataTable)
    {
        return $dataTable->render('admin.stays.index');
    }

    public function store()
    {
        request()->validate([
            'name' => ['required', 'string'],
            'type' => ['required', 'in:hotels,apartments,chales'],
            'description' => ['required', 'string'],
            'city' => ['required', 'string'],
            'streetaddress' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'numberofbedrooms' => ['required', 'integer'],
            'maxnumofguests' => ['required', 'integer'],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg,wepb', 'max:8192'],
        ]);

        $user = auth()->user();

        $data = new Stays;
        $data->user_id = $user->id;
        $data->name = request('name');
        $data->type = request('type');
        $data->description = request('description');
        $data->city = request('city');
        $data->streetaddress = request('streetaddress');
        $data->price = request('price');
        $data->numberofbedrooms = request('numberofbedrooms');
        $data->maxnumofguests = request('maxnumofguests');
        $data->save();

        if (request()->has('images')) {
            foreach (request()->file('images') as $image) {
                $path = $image->store('stay_images', 'public');

                $pic = new StaysPics;
                $pic->stay_id = $data->id;
                $pic->path = $path; // Store the path
                $pic->save();
            }
        }

        return response()->json(['success' => 'Successfully Created']);
    }

    public function edit($id)
    {
        $data = Stays::find($id);

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
            'name' => ['required', 'string'],
            'type' => ['required', 'in:hotels,apartments,chales'],
            'description' => ['required', 'string'],
            'city' => ['required', 'string'],
            'streetaddress' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'numberofbedrooms' => ['required', 'integer'],
            'maxnumofguests' => ['required', 'integer'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg,wepb', 'max:8192'],
        ]);

        $user = auth()->user();

        $data = Stays::find($id);
        if (!$data) {
            return response()->json(['error' => 'not found.'], 404);
        }

        $data->user_id = $user->id;
        $data->name = request('name');
        $data->type = request('type');
        $data->description = request('description');
        $data->city = request('city');
        $data->streetaddress = request('streetaddress');
        $data->price = request('price');
        $data->numberofbedrooms = request('numberofbedrooms');
        $data->maxnumofguests = request('maxnumofguests');
        $data->save();

        // Upload and save new images
        if (request()->has('images')) {

            $oldImages = $data->staysPics; // Get related images
            foreach ($oldImages as $image) {
                $imagePath = storage_path('app/public/' . $image->path);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Remove the file from storage
                }
                $image->delete(); // Remove the database record
            }


            foreach (request()->file('images') as $image) {
                $path = $image->store('car_images', 'public');

                $pic = new StaysPics;
                $pic->stay_id = $data->id;
                $pic->path = $path; // Store the path
                $pic->save();
            }
        }

        return response()->json(['success' => 'Successfully Updated']);
    }

    public function destroy($id)
    {
        $data = Stays::find($id);
        if (!$data) {
            return response()->json(['error' => 'not found.'], 404);
        }
        $data->delete();

        return response()->json(['success' => 'Successfully Deleted']);
    }

    public function isrecommended($id){
        $data = Stays::find($id);
        $data->is_recommended = !$data->is_recommended;
        $data->save();
        return response()->json(['success' => 'Successfully updated']);
    }
}
