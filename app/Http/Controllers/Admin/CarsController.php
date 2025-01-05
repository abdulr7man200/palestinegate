<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cars;
use App\Models\CarType;
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
        $data->save();



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
        $data->save();


        return response()->json(['success' => 'Successfully Updated']);
    }

    public function destroy($id){
        $data = Cars::find($id);
        if (!$data) {
            return response()->json(['error' => 'not found.'], 404);
        }
        $data->delete();

        return response()->json(['success' => 'Successfully Deleted']);
    }
}
