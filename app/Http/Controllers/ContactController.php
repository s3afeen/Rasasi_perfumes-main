<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.contacts.index' , ['contacts'=> $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'Fname' => 'required|string',
            'Lname' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required',
        ]);

        Contact::create([
            'Fname'=>$request->input('Fname'),
            'Lname'=>$request->input('Lname'),
            'email'=>$request->input('email'),
            'subject'=>$request->input('subject'),
            'message'=>$request->input('message'),



        ]);
        return redirect()->back()->with('success', 'Thanks for contact us');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('dashboard.contacts.show' , ['contact'=> $contact]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return to_route('contacts.index')->with('success', 'Message deleted');
    }
}
