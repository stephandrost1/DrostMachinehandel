<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserCompany;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (!Auth::user()) {
                throw new Exception("User is not logged in!");
            }

            $user = User::with('address', 'company')->find(Auth::id());

            if (empty($user)) {
                throw new Exception("User not found!");
            }

            return response()->json(["user" => $user], 200);
        } catch (Exception $e) {
            Log::alert(
                "userController",
                [
                    "action" => "show",
                    "user" => Auth::user(),
                    "error" => $e->getMessage(),
                ]
            );
            return response()->json(["message" => "er is iets fout gegaan, probeer het later opnieuw!"], 500);
        }
    }

    public function pager($pageId, Request $request)
    {
        try {
            $searchQuery = '%' . $request->s . '%';

            $users = User::where("role_id", "1")->with('address', 'company')
                ->where('name', 'like', $searchQuery)
                ->orWhere('email', 'like', $searchQuery)
                ->orWhereHas('company', function ($query) use ($searchQuery) {
                    $query->where('name', 'like', $searchQuery)
                        ->orWhere('kvknumber', 'like', $searchQuery);
                })
                ->orderBy("deleted_at")
                ->orderBy('email_verified_at')
                // ->withTrashed()
                ->get()->toArray();

            $pages = array_chunk($users, 15);

            return response()->json([
                "users" => $pages[$pageId - 1] ?? [],
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
        // If the maximum number of pages is 0, return empty array
        return $maxPages == 0 ? []
            // If the maximum number of pages is 1, return just that page
            : ($maxPages == 1 ? [1]
                // If the maximum number of pages is 2, return the first two pages
                : ($maxPages == 2 ? [1, 2]
                    // If the maximum number of pages is 3, return the first three pages
                    : ($maxPages == 3 ? [1, 2, 3]
                        // If the current page is the first or second page, return the next three pages
                        : ($page <= 1 ? [$page, $page + 1, $page + 2]
                            // If the current page is the last or second-to-last page, return the previous three pages
                            : ($page >= $maxPages ? [$maxPages - 2, $maxPages - 1, $maxPages]
                                // Otherwise, return the three pages centered around the current page
                                : [$page - 1, $page, $page + 1])))));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $validator = $request->validated();

            $user = User::create([
                "name" => $request->firstname . ' ' . $request->lastname,
                "email" => $request->email,
                "phonenumber" => $request->phonenumber,
                "password" => Hash::make($request->password),
                "role_id" => "1"
            ]);

            $userAddress = UserAddress::create([
                "user_id" => $user->id,
                "country" => $request->country,
                "province" => $request->province,
                "city" => $request->city,
                "streetname" => $request->streetname,
                "housenumber" => $request->housenumber,
                "postalcode" => $request->postalcode,
            ])->save();

            $userCompany = UserCompany::create([
                "user_id" => $user->id,
                "name" => $request->companyname,
                "kvknumber" => $request->kvknumber,
                "btwnumber" => $request->btwnumber,
            ]);

            session()->flash('success', 'Uw account is succesvol aangemaakt!');
            return redirect()->route("login");
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::find($id);

            if (empty($user)) {
                throw new Exception("User with id: $id not found!");
            }

            return response()->json(["user" => $user], 200);
        } catch (Exception $e) {
            Log::alert(
                "userController",
                [
                    "action" => "show",
                    "id" => $id,
                    "error" => $e->getMessage(),
                ]
            );
            return response()->json(["message" => "er is iets fout gegaan, probeer het later opnieuw!"], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDealer(Request $request, $id)
    {
        //TODO CREATE A CUSTOM REQUEST AND VALIDATE IT
        try {
            // $validated = $request->validated();

            $emailAccounts = collect(User::where('email', $request->email)->whereNot('id', $request->id)->get())->toArray();

            if (count($emailAccounts) > 0) {
                throw new Exception("E-mailadres is al in gebruik!");
            }

            $user = User::find($id);

            $user->fill([
                "name" => $request->name,
                "email" => $request->email,
                "phonenumber" => $request->phonenumber
            ])->save();

            $this->updateUserCompany($id, $request);
            $this->updateUserAddress($id, $request);

            return response()->json(["message" => "Gebruiker succesvol geupdate"], 200);
        } catch (Exception $e) {
            Log::emergency("UserController", [
                "action" => "Update",
                "id" => $id,
                "error" => $e->getMessage()
            ]);

            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $validated = $request->validated();

            $emailAccounts = collect(User::where('email', $request->email)->whereNot('id', $request->id)->get())->toArray();

            if (count($emailAccounts) > 0) {
                throw new Exception("E-mailadres is al in gebruik!");
            }

            if ($request->password !== $request->passwordRepeat) {
                throw new Exception("Opgegeven wachtwoorden komen niet overeen");
            }

            $user = User::find($id);

            if (!Hash::check($request->currentPassword, $user->password)) {
                throw new Exception("Opgegeven huidige wachtwoord is niet correct!");
            }

            $user->fill([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "phonenumber" => $request->phonenumber
            ])->save();

            $this->updateUserCompany($id, $request);
            $this->updateUserAddress($id, $request);

            return response()->json(["message" => "Gebruiker succesvol geupdate"], 200);
        } catch (Exception $e) {
            Log::emergency("UserController", [
                "action" => "Update",
                "id" => $id,
                "error" => $e->getMessage()
            ]);

            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage()], 500);
        }
    }

    private function updateUserCompany(string $id, $request)
    {
        try {
            $userCompany = UserCompany::where("user_id", $id)->get()->first();

            if (empty($userCompany)) {
                return;
            }

            $userCompany->fill($request->toArray()["company"])->save();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function updateUserAddress(string $id, $request)
    {
        try {
            $UserAddress = UserAddress::where("user_id", $id)->get()->first();

            if (empty($UserAddress)) {
                return;
            }

            $UserAddress->fill($request->toArray()["address"])->save();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $dealer = User::find($id);

            if (empty($dealer)) {
                throw new Exception("Handelaar niet gevonden!");
            }

            $dealer->delete();

            return response()->json(["message" => "Handelaar is succesvol verwijderd", "status" => true], 200);
        } catch (Exception $e) {
            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage(), "status" => true], 400);
        }
    }

    public function activate($id)
    {
        try {
            $user = User::find($id);

            if (empty($user)) {
                throw new Exception("Gebruiker niet gevonden!");
            }

            $user->update([
                "email_verified_at" => Carbon::now()
            ]);

            return response()->json(["message" => "Gebruiker succesvol geactiveerd!"]);
        } catch (Exception $e) {

            Log::emergency("UserController", [
                "id" => $id,
                "error" => $e->getMessage(),
                "function" => "activate"
            ]);

            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage()], 500);
        }
    }

    public function deactivate($id)
    {
        try {
            $user = User::find($id);

            if (empty($user)) {
                throw new Exception("Gebruiker niet gevonden!");
            }

            $user->update([
                "email_verified_at" => null
            ]);

            return response()->json(["message" => "Gebruiker succesvol gedeactiveerd!"]);
        } catch (Exception $e) {

            Log::emergency("UserController", [
                "id" => $id,
                "error" => $e->getMessage(),
                "function" => "deactivate"
            ]);

            return response()->json(["message" => "Er is iets fout gegaan: " . $e->getMessage()], 500);
        }
    }
}
