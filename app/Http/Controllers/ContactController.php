<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = Contact::nameLike($request->name)
            ->rutLike($request->rut)
            ->paginate(10);

        Session([
            'name' => $request->name,
            'rut'  => $request->rut
        ]);

        return view('welcome', compact('contacts'));
    }
}
