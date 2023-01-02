<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
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
            $user = Auth::getUser();

            if (empty($user)) {
                throw new Exception("User is not logged in!");
            }

            $id = $user->id;

            if (empty($id)) {
                throw new Exception("User id not found!");
            }

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

            if (!Hash::check($request->password, $user->password)) {
                throw new Exception("Opgegeven huidige wachtwoord is niet correct!");
            }

            $user->fill([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ])->save();

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
