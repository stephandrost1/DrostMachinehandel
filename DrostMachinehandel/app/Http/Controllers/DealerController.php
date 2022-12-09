<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDealerRequest;
use App\Http\Requests\UpdateDealerRequest;
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

    public function getAll($pageId)
    {
        try {
            $dealers = collect(Dealer::all())->map(function ($dealer) {
                return [
                    "id" => $dealer->id,
                    "firstname" => $dealer->firstname,
                    "lastname" => $dealer->lastname,
                    "email" => $dealer->email,
                    "phonenumber" => $dealer->phonenumber,
                    "companyname" => $dealer->companyname,
                    "kvknumber" => $dealer->kvknumber,
                    "email_verified_at" => $dealer->email_verified_at,
                ];
            })->toArray();

            $pages = array_chunk($dealers, 15);

            return response()->json([
                "dealers" => $pages[$pageId - 1] ?? [],
                "pages" => count($pages),
                "status" => true
            ], 200);
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

    public function deactive($id)
    {
        try {
            $dealer = Dealer::find($id);

            if (empty($dealer)) {
                throw new Exception("Handelaar niet gevonden!");
            }

            $dealer->email_verified_at = null;
            $dealer->save();

            return response()->json(["message" => "Handelaar is succesvol gedeactiveerd", "status" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage(), "status" => true], 400);
        }
    }

    public function active($id)
    {
        try {
            $dealer = Dealer::find($id);

            if (empty($dealer)) {
                throw new Exception("Handelaar niet gevonden!");
            }

            $dealer->email_verified_at = now();
            $dealer->save();

            return response()->json(["message" => "Handelaar is succesvol geactiveerd", "status" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage(), "status" => true], 400);
        }
    }

    public function delete($id)
    {
        try {
            $dealer = Dealer::find($id);

            if (empty($dealer)) {
                throw new Exception("Handelaar niet gevonden!");
            }

            $dealer->delete();

            return response()->json(["message" => "Handelaar is succesvol verwijderd", "status" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage(), "status" => true], 400);
        }
    }

    public function update(UpdateDealerRequest $request)
    {
        try {
            $validated = $request->validated();

            $dealer = Dealer::find($request->id);

            if (empty($dealer)) {
                throw new Exception("Handelaar niet gevonden!");
            }



            return response()->json(["message" => "Handelaar is succesvol geupdate!", "status" => true], 400);
        } catch (Exception $e) {
            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage(), "status" => true], 400);
        }
    }
}
