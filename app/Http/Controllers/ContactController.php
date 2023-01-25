<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\UrlHelper;
use ZipArchive;

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
            Mail::to(SettingsController::fetchSetting("contact_email"))->send(new \App\Mail\ContactMail($details));
            return view('contact', ['statusCode' => 200]);
        } catch (Exception $e) {
            return view('contact', ['statusCode' => 400]);
        }
        return view('contact', ['statusCode' => 200]);
    }
}
