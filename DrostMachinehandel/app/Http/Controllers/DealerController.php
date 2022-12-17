<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDealerRequest;
use App\Http\Requests\UpdateDealerRequest;
use App\Models\Dealer;
use App\Models\DealerAddress;
use Exception;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;

class DealerController extends Controller
{
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

    public function getPageNumbers(int $maxPages, int $page): array
    {
        // If the maximum number of pages is 1, return just that page
        return $maxPages == 1 ? [1]
            // If the maximum number of pages is 2, return the first two pages
            : ($maxPages == 2 ? [1, 2]
                // If the maximum number of pages is 3, return the first three pages
                : ($maxPages == 3 ? [1, 2, 3]
                    // If the current page is the first or second page, return the next three pages
                    : ($page <= 1 ? [$page, $page + 1, $page + 2]
                        // If the current page is the last or second-to-last page, return the previous three pages
                        : ($page >= $maxPages ? [$maxPages - 2, $maxPages - 1, $maxPages]
                            // Otherwise, return the three pages centered around the current page
                            : [$page - 1, $page, $page + 1]))));
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

            $emailAccounts = collect(Dealer::where('email', $request->email)->whereNot('id', $request->id)->get())->toArray();
            $kvkNumbers = collect(Dealer::where('kvknumber', $request->kvknumber)->whereNot('id', $request->id)->get())->toArray();

            if (count($emailAccounts) > 0) {
                throw new Exception("E-mailadres is al in gebruik!");
            }

            if (count($kvkNumbers) > 0) {
                throw new Exception("Kvk nummer is al in gebruik!");
            }

            $dealer->firstname = $request->firstname;
            $dealer->lastname = $request->lastname;
            $dealer->email = $request->email;
            $dealer->phonenumber = $request->phonenumber;
            $dealer->companyname = $request->companyname;
            $dealer->kvknumber = $request->kvknumber;
            $dealer->email_verified_at = $request->email_verified_at;
            $dealer->save();

            return response()->json(["message" => "Handelaar is succesvol geupdate!", "status" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage(), "status" => true], 400);
        }
    }
}
