<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;


class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Contact::paginate(10);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request) //method injection - umesto Request smo nalepili ContactRequest
    {
        //PRVI NACIN ZA VALIDACIJU PODATAKA
        //validacija za unos kontakata, moze i ovako samo u
        // $this->validate(
        //     $request,
        //     [
        //         'first_name' => 'required',
        //         'last_name' => 'required',
        //         'email' => 'required|unique:contacts,email',
        //     ]
        // );

        //DRUGI NACIN ZA VALIDACIJU PODATAKA
        // $request->validate([
        //     'first_name' => 'required',
        //     'last_name' => 'required',
        //     'email' => 'required|unique:contacts,email',
        // ]);

        // dd($validation); //za debugging

        return Contact::create(
            $request->only([ 'first_name', 'last_name', 'email' ])
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Contact  $contact
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Contact $contact)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    //ContactRequest umesto Requesta - injektovali smo ContactRequest
    public function update(ContactRequest $request, Contact $contact) //Contact model je bind, to znaci da on zna da uzme kontakt, ne moramo mi rucno da ga trazimo po id
    {
        $contact->update(
            $request->only([ 'first_name', 'last_name', 'email' ])
        );
        return $contact; //returnujemo updateovan contact
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return $contact;
    }
}
