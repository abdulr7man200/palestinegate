<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cars;
use App\Models\CarPics;
use Illuminate\Http\Request;
use App\DataTables\CarsDataTable;
use App\Http\Controllers\Controller;

class CarsController extends Controller
{
    public function index(CarsDataTable $dataTable)
    {
        return $dataTable->render('admin.cars.index');
    }

    public function store()
    {

        request()->validate([
            'price_per_day' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string'],
            'type' => ['required', 'string'],
            'model' => ['required', 'string'],
            'year' => ['required', 'integer'],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg,wepb'],
            'main_pic' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'banner' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        $user = auth()->user();


        $data = new Cars;
        $data->user_id = $user->id;
        $data->price_per_day = request('price_per_day');
        $data->description = request('description');
        $data->location = request('location');
        $data->type = request('type');
        $data->model = request('model');
        $data->year = request('year');
        if (request()->hasFile('main_pic')) {
            $mainPicPath = request()->file('main_pic')->store('car_main_pics', 'public');
            $data->main_pic = $mainPicPath;
        }
        if (request()->hasFile('banner')) {
            $bannerPath = request()->file('banner')->store('car_banners', 'public');
            $data->banner = $bannerPath;
        }
        $data->save();



        if (request()->has('images')) {
            foreach (request()->file('images') as $image) {
                $path = $image->store('car_images', 'public');

                $pic = new CarPics;
                $pic->car_id = $data->id;
                $pic->path = $path; // Store the path
                $pic->save();
            }
        }


        return response()->json(['success' => 'Successfully Created']);
    }

    public function edit($id)
    {
        $data = Cars::find($id);

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
            'price_per_day' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'location' => ['required', 'string'],
            'type' => ['required', 'string'],
            'model' => ['required', 'string'],
            'year' => ['required', 'integer'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg,wepb'],
            'main_pic' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'banner' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
        ]);

        $user = auth()->user();

        $data = Cars::find($id);
        $data->user_id = $user->id;
        $data->price_per_day = request('price_per_day');
        $data->description = request('description');
        $data->location = request('location');
        $data->type = request('type');
        $data->model = request('model');
        $data->year = request('year');
        if (request()->hasFile('main_pic')) {
            // Delete the old main_pic if exists
            if ($data->main_pic) {
                $oldMainPicPath = storage_path('app/public/' . $data->main_pic);
                if (file_exists($oldMainPicPath)) {
                    unlink($oldMainPicPath); // Remove old file from storage
                }
            }
            // Store the new main_pic
            $mainPicPath = request()->file('main_pic')->store('car_main_pics', 'public');
            $data->main_pic = $mainPicPath;
        }

        if (request()->hasFile('banner')) {
            // Delete the old banner if exists
            if ($data->banner) {
                $oldBannerPath = storage_path('app/public/' . $data->banner);
                if (file_exists($oldBannerPath)) {
                    unlink($oldBannerPath); // Remove old file from storage
                }
            }
            // Store the new banner
            $bannerPath = request()->file('banner')->store('car_banners', 'public');
            $data->banner = $bannerPath;
        }
        $data->save();





        // Upload and save new images
        if (request()->has('images')) {

            // Remove old images from storage and database
            $oldImages = $data->carPics; // Get related images
            foreach ($oldImages as $image) {
                $imagePath = storage_path('app/public/' . $image->path);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Remove the file from storage
                }
                $image->delete(); // Remove the database record
            }


            foreach (request()->file('images') as $image) {
                $path = $image->store('car_images', 'public');

                $pic = new CarPics;
                $pic->car_id = $data->id;
                $pic->path = $path; // Store the path
                $pic->save();
            }
        }


        return response()->json(['success' => 'Successfully Updated']);
    }

    public function destroy($id)
    {
        $data = Cars::find($id);
        if (!$data) {
            return response()->json(['error' => 'not found.'], 404);
        }
        $data->delete();

        return response()->json(['success' => 'Successfully Deleted']);
    }
    public function isrecommended($id){
        $data = Cars::find($id);
        $data->is_recommended = !$data->is_recommended;
        $data->save();
        return response()->json(['success' => 'Successfully updated']);
    }
}
