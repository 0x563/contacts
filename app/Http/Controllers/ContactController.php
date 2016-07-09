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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Returns contacts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apiSearch(Request $request)
    {
        return Contact::nameLike($request->name)
            ->rutLike($request->rut)
            ->paginate(11);
    }
}
