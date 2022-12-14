<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDealerRequest;
use App\Http\Requests\UpdateDealerRequest;
use App\Models\Dealer;
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
        // If there are no pages, return an empty array
        if ($maxPages == 0) {
            return [];
        }

        // Return an array with the three page numbers centered around the current page
        return $page <= 1
            // If the current page is 1 or less, return the first three page numbers
            ? [1, 2, 3]
            // Otherwise, if the current page is greater than or equal to the maximum number of pages, return the last three page numbers
            : ($page >= $maxPages
                ? [$maxPages - 2, $maxPages - 1, $maxPages]
                // Otherwise, return the three page numbers centered around the current page
                : [$page - 1, $page, $page + 1]);
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
