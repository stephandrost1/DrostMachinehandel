<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\UrlHelper;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = URL::full();

        $params = explode("?", $url);

        if (isset($params[1])) {
            $param = $params[1];

            $status = explode("=", $param);

            if ($status[0] === "status") {
                $statusCode = $status[1];

                return view('contact', ['statusCode' => $statusCode]);
            }

            return view('contact');
        }

        return view('contact');
    }

    public function submitRequest(Request $request)
    {
        $details = [
            'title' => 'Nieuw bericht op Drostmachinehandel.nl',
            'firstname' => $request->firstname ?? 'Voornaam is niet beschikbaar',
            'lastname' => $request->lastname ?? 'Achternaam is niet beschikbaar',
            'phonenumber' => $request->phonenumber ?? 'Niet ingevuld',
            'email' => $request->email ?? 'Email is niet beschikbaar',
            'message' => $request->message ?? 'Bericht is niet beschikbaar',
        ];

        try {
            Mail::to('henrikH2004@hotmail.com')->send(new \App\Mail\ContactMail($details));
            return view('contact', ['statusCode' => 200]);
        } catch (Exception $e) {
            return view('contact', ['statusCode' => 400]);
        }
        return view('contact', ['statusCode' => 200]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}