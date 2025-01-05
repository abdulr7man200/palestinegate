<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('welcome');
    }
 
    public function Services(){
        return view('Services');
    }
    public function stays(){
        return view('stays');
    }
    public function cars(){
        return view('cars');
    }
    

}
