<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\RentFilter;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect()->route("dashboard-verhuur");
    }

    public function vehicles()
    {
        return view('dashboard/vehicles');
    }

    public function verhuur()
    {
        $rentVehicles = Vehicle::all();

        $filters = RentFilter::with("options")->get();

        return view("dashboard/verhuur", [
            "machines" => $rentVehicles,
            "filters" => $filters
        ]);
    }

    public function dealerCreate()
    {
        return view("dashboard/dealerCreate");
    }

    public function dealerRequests()
    {
        return view("dashboard/dealerRequests");
    }

    public function statistics()
    {

        return view("dashboard/statistics");
    }

    public function account()
    {
        $user = Auth::user();

        return view("dashboard/account", ['user' => $user]);
    }

    public function updateAccount(Request $request)
    {
        $user = Auth::user();

        // if (!Hash::check($request->password, $user->password)) {
        //     return response()->json(["message" => "Het huidige wachtwoord is onjuist!", "status" => true], 400);
        // } else {
        //     $user = User::find($user->id);

        //     if ($request->new_password && $request->confirm_new_password) {
        //         if ($request->new_password == $request->confirm_new_password) {
        //             $user->update([
        //                 'password' => Hash::make($request->new_password),
        //             ]);
        //         } else {
        //             return response()->json(["message" => "De wachtwoorden komen niet overeen!", "status" => true], 400);
        //         }
        //     }

        //     if (!$request->new_password && $request->confirm_new_password || $request->new_password && !$request->confirm_new_password) {
        //         return response()->json(["message" => "Vul beide wachtwoord velden in!", "status" => true], 400);
        //     }

        //     $user->update([
        //         'name' => $request->name,
        //         'email' => $request->email,
        //     ]);

        //     return response()->json(["message" => "Account is succesvol geüpdatet", "status" => true], 200);
        // }

        return back();
    }

    public function reservations()
    {
        return view("dashboard/reservations");
    }

    public function settings()
    {
        return view("dashboard/settings");
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/dashboard');
    }
}
