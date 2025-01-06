<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stays;
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
            'Type' => ['required', 'string'],
            'description' => ['required', 'string'],
            'city' => ['required', 'string'],
            'streetaddress' => ['required', 'integer'],
            'amenities' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'numberofbedrooms' => ['required', 'integer'],
            'maxnumofguests' => ['required', 'integer'],
        ]);

        $user = auth()->user();

        $data = new Stays;
        $data->user_id = $user->id;
        $data->name = request('name');
        $data->Type = request('Type');
        $data->description = request('description');
        $data->city = request('city');
        $data->streetaddress = request('streetaddress');
        $data->amenities = request('amenities');
        $data->price = request('price');
        $data->numberofbedrooms = request('numberofbedrooms');
        $data->maxnumofguests = request('maxnumofguests');
        $data->save();

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
            'Type' => ['required', 'string'],
            'description' => ['required', 'string'],
            'city' => ['required', 'string'],
            'streetaddress' => ['required', 'integer'],
            'amenities' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'numberofbedrooms' => ['required', 'integer'],
            'maxnumofguests' => ['required', 'integer'],
        ]);

        $user = auth()->user();

        $data = Stays::find($id);
        if (!$data) {
            return response()->json(['error' => 'not found.'], 404);
        }

        $data->user_id = $user->id;
        $data->name = request('name');
        $data->Type = request('Type');
        $data->description = request('description');
        $data->city = request('city');
        $data->streetaddress = request('streetaddress');
        $data->amenities = request('amenities');
        $data->price = request('price');
        $data->numberofbedrooms = request('numberofbedrooms');
        $data->maxnumofguests = request('maxnumofguests');
        $data->save();

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
}
