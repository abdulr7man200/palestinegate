<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required'
        ]);

        $user = auth()->user();

        $contact = new ContactUs();
        $contact->user_id =  $user->id;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->save();


        return redirect()->route('contactus')->with('message', 'Thank you for your message.');
    }
}
