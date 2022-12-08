<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDealerRequest;
use App\Models\Dealer;
use Exception;
use Illuminate\Support\Facades\Hash;

class DealerController extends Controller
{
    public function create(CreateDealerRequest $request)
    {
        try {
            $validated = $request->validated();

            $dealer = new Dealer();
            $dealer->firstname = $request->firstname;
            $dealer->lastname = $request->lastname;
            $dealer->email = $request->email;
            $dealer->phonenumber = $request->phonenumber;
            $dealer->companyname = $request->companyname;
            $dealer->kvknumber = $request->kvknumber;
            $dealer->password = Hash::make($request->kvknumber);
            $dealer->email_verified_at = null;

            return redirect()->back()->with("status", "succes");
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getAll()
    {
        try {
            $dealers = Dealer::all();

            return response()->json(["dealers" => $dealers, "status" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage(), "status" => true], 400);
        }
    }

    public function getPending()
    {
        try {
            $dealers = Dealer::whereNull("email_verified_at")->get();

            return response()->json(["dealers" => $dealers, "status" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage(), "status" => true], 400);
        }
    }

    public function getActive()
    {
        try {
            $dealers = Dealer::whereNotNull("email_verified_at")->get();

            return response()->json(["dealers" => $dealers, "status" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage(), "status" => true], 400);
        }
    }
}
