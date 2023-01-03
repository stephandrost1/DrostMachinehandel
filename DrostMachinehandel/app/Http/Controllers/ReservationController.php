<?php

namespace App\Http\Controllers;

use App\Models\DealerVehicle;
use App\Models\Reservation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function index($pageId, Request $request)
    {
        try {
            $searchQuery = '%' . $request->s . '%';

            $reservations = Reservation::with('dealer.address', 'vehicle')
                ->whereHas('dealer', function ($query) use ($searchQuery) {
                    $query->where('firstname', 'like', "%$searchQuery%")
                        ->orWhere('lastname', 'like', "%$searchQuery%")
                        ->orWhere('email', 'like', "%$searchQuery%")
                        ->orWhere('companyname', 'like', "%$searchQuery%")
                        ->orWhere('kvknumber', 'like', "%$searchQuery%")
                        ->orWhereHas('address', function ($query) use ($searchQuery) {
                            $query->where('country', 'like', "%$searchQuery%")
                                ->orWhere('province', 'like', "%$searchQuery%")
                                ->orWhere('city', 'like', "%$searchQuery%")
                                ->orWhere('streetname', 'like', "%$searchQuery%")
                                ->orWhere('housenumber', 'like', "%$searchQuery%")
                                ->orWhere('postalcode', 'like', "%$searchQuery%");
                        });
                })
                ->orWhereHas('vehicle', function ($query) use ($searchQuery) {
                    $query->where('vehicle_name', 'like', "%$searchQuery%");
                })
                ->get()
                ->toArray();

            $pages = array_chunk($reservations, 15);

            return response()->json([
                "reservations" => $pages[$pageId - 1] ?? [],
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

    public function store(Request $request)
    {
        try {
            Log::emergency("reservation", [$request->toArray()]);

            if (empty($request->vehicleId)) {
                throw new Exception("Vehicle id niet gevonden!");
            }

            $vehicle = DealerVehicle::find($request->vehicleId);

            if (empty($vehicle)) {
                throw new Exception("Vehicle niet gevonden!");
            }

            if (empty($request->startDate)) {
                return response()->json(["message" => "Er is geen geldige startdatum ingevuld!"], 500);
            }

            if (empty($request->endDate)) {
                return response()->json(["message" => "Er is geen geldige einddatum ingevuld!"], 500);
            }

            return response()->json(["message" => "Reservering is succesvol aangemaakt!"], 200);
        } catch (Exception $e) {
            Log::emergency("ReservationController", [
                "error" => $e->getMessage(),
                "request" => $request->toArray(),
            ]);

            return response()->json(["message" => "Er is iets fout gegaan, probeer het later opnieuw!"], 500);
        }
    }
}
