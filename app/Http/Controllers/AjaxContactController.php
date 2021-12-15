<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class AjaxContactController extends Controller
{
    public function index()
    {
        return view('ajax-contact-form');
    }
    public function store(Request $request)
    {
        $contact = new Contact;
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->description = $request->description;
        $contact->date = $request->date;
        $contact->save();
        return response()->json(['success' => true]);
    }
}
