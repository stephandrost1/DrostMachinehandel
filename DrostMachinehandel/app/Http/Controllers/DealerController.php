<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDealerRequest;
use App\Http\Requests\UpdateDealerRequest;
use App\Models\Dealer;
use App\Models\DealerAddress;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DealerController extends Controller
{
    public function index()
    {
        try {
            if (!Auth::user()) {
                throw new Exception("User is not logged in!");
            }

            $user = User::find(Auth::id());

            if (!$user->hasRole(["Dealer"])) {
                throw new Exception("User has not the correct roles");
            }

            $id = Auth::id();

            if (empty($id)) {
                throw new Exception("User id not found!");
            }

            $dealer = Dealer::select("id", "firstname", "lastname", "email", "phonenumber", "companyname", "kvknumber", "btwnumber")->with("address")->find($id);

            if (empty($dealer)) {
                throw new Exception("Dealer with id: $id not found!");
            }

            return response()->json(["dealer" => $dealer], 200);
        } catch (Exception $e) {
            Log::alert(
                "dealerContrller",
                [
                    "action" => "show",
                    "id" => $id ?? "id not found! user might not been logged in",
                    "error" => $e->getMessage(),
                ]
            );
            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $dealer = Dealer::select("id", "firstname", "lastname", "email", "phonenumber", "companyname", "kvknumber", "btwnumber")->with("address")->find($id);

            if (empty($dealer)) {
                throw new Exception("Dealer with id: $id not found!");
            }

            return response()->json(["dealer" => $dealer], 200);
        } catch (Exception $e) {
            Log::alert(
                "dealerContrller",
                [
                    "action" => "show",
                    "id" => $id,
                    "error" => $e->getMessage(),
                ]
            );
            return response()->json(["message" => "er is iets fout gegaan, probeer het later opnieuw!"], 500);
        }
    }

    public function create(CreateDealerRequest $request)
    {
        try {
            $validated = $request->validated();

            $dealer = new Dealer();
            $dealer->fill([
                "firstname" => $request->firstname,
                "lastname" => $request->lastname,
                "email" => $request->email,
                "phonenumber" => $request->phonenumber,
                "companyname" => $request->companyname,
                "kvknumber" => $request->kvknumber,
                "password" => Hash::make($request->password),
                "email_verified_at" => null,
            ])->save();

            $dealerAdress = new DealerAddress();
            $dealerAdress->fill([
                "country" => $request->country,
                "province" => $request->province,
                "city" => $request->city,
                "streetname" => $request->streetname,
                "housenumber" => $request->housenumber,
                "postalcode" => $request->postalcode,
                "dealer_id" => $dealer->id,
            ])->save();

            return redirect()->back()->with("status", "succes");
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function getAll($pageId, Request $request)
    {
        try {
            $searchQuery = '%' . $request->s . '%';

            $dealers = Dealer::select("id", "firstname", "lastname", "email", "phonenumber", "companyname", "kvknumber", "email_verified_at")
                ->orWhere('firstname', 'like', $searchQuery)
                ->orWhere('lastname', 'like', $searchQuery)
                ->orWhere('email', 'like', $searchQuery)
                ->orWhere('companyname', 'like', $searchQuery)
                ->orWhere('kvknumber', 'like', $searchQuery)
                ->orderBy('id', 'desc')
                ->orderBy('email_verified_at', 'asc')
                ->get()->toArray();

            $pages = array_chunk($dealers, 15);

            return response()->json([
                "dealers" => $pages[$pageId - 1] ?? [],
                "pages" => $this->getPageNumbers(count($pages), $pageId),
                "maxPages" => count($pages),
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

    public function deactivate($id)
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

    public function activate($id)
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
            $dealerAddress = DealerAddress::where("dealer_id", $request->id)->get()->first();

            if (empty($dealer)) {
                throw new Exception("Handelaar niet gevonden!");
            }

            if (empty($dealerAddress)) {
                throw new Exception("Handelaar adres niet gevonden!");
            }

            $emailAccounts = collect(Dealer::where('email', $request->email)->whereNot('id', $request->id)->get())->toArray();
            $kvkNumbers = collect(Dealer::where('kvknumber', $request->kvknumber)->whereNot('id', $request->id)->get())->toArray();

            if (count($emailAccounts) > 0) {
                throw new Exception("E-mailadres is al in gebruik!");
            }

            if (count($kvkNumbers) > 0) {
                throw new Exception("Kvk nummer is al in gebruik!");
            }

            if (Auth::guard("dealer")->check() && isset($request->password) && (!isset($request->passwordRepeat) || ($request->password != $request->passwordRepeat) || !isset($request->currentPassword) || !Hash::check($request->currentPassword, $dealer->getAuthPassword()))) {
                throw new Exception("Het huidige wachtwoord komt niet overeen met het opgegeven huidige wachtwoord!");
            } else if (Auth::guard("dealer")->check() && isset($request->password) && isset($request->passwordRepeat) && ($request->password == $request->passwordRepeat) && (isset($request->currentPassword) || Hash::check($request->currentPassword, $dealer->getAuthPassword()))) {
                $dealer->fill([
                    "password" => Hash::make($request->password)
                ])->save();
            } else if (Auth::guard("user") && isset($request->password) && !empty($request->password)) {
                $dealer->fill([
                    "password" => Hash::make($request->password)
                ])->save();
            }

            $dealer->fill([
                "firstname" => $request->firstname,
                "lastname" => $request->lastname,
                "email" => $request->email,
                "phonenumber" => $request->phonenumber,
                "companyname" => $request->companyname,
                "kvknumber" => $request->kvknumber,
                "btwnumber" => $request->btwnumber,
                "email_verified_at" => $request->email_verified_at ?? null,
            ])->save();

            $dealerAddress->fill($request->toArray()["address"])->save();

            return response()->json(["message" => "Handelaar is succesvol geupdate!", "status" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage(), "status" => true], 400);
        }
    }
}
