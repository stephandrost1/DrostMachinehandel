<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoorraadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('voorraad');
    }

    public function detail()
    {
        return view('detail');
    }
}
