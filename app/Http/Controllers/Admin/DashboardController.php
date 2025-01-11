<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cars;
use App\Models\Stays;
class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function contactus(){
        return view('contactus');
    }
    public function aboutus(){
        return view('aboutus');
    }
    public function welcome(){
        $cars = Cars::with(['carPics'])
        ->take(10)
        ->inRandomOrder()
        ->get();
        $stays = Stays::with(['staysPics'])
        ->take(10)
        ->inRandomOrder()
        ->get();

        $carsrec = Cars::with(['carPics'])
        ->where('is_recommended', true) // Filter recommended cars
        ->take(10)
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

    public function Services(){
        $cars = Cars::with(['carPics'])
        ->take(10)
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


    public function cars(){
        return view('cars');
    }


}
