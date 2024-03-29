<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOccasionsReservationRequest;
use App\Http\Requests\CreateReservationRequest;
use App\Mail\OccasionsReservationMail;
use App\Mail\ReservationMail;
use App\Models\Dealer;
use App\Models\DealerVehicle;
use App\Models\GuestUser;
use App\Models\GuestUserAddress;
use App\Models\GuestUserCompany;
use App\Models\OccasionsReservation;
use App\Models\PostalcodeCoord;
use App\Models\PostalcodeDistance;
use App\Models\Reservation;
use App\Models\ReservationDate;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function index($pageId, Request $request)
    {
        try {
            $searchQuery = '%' . $request->s . '%';

            $authReservations = Reservation::where("auth_type", "Auth")
                ->where(function ($query) use ($searchQuery) {
                    $query->whereHas("user", function ($query) use ($searchQuery) {
                        $query->where(function ($query) use ($searchQuery) {
                            $query->where('name', 'like', "%$searchQuery%")
                                ->orWhere('email', 'like', "%$searchQuery%")
                                ->orWhere('phonenumber', 'like', "%$searchQuery%")
                                ->orWhereHas('address', function ($query) use ($searchQuery) {
                                    $query->where('streetname', 'like', "%$searchQuery%")
                                        ->orWhere('housenumber', 'like', "%$searchQuery%")
                                        ->orWhere('postalcode', 'like', "%$searchQuery%");
                                })->orWhereHas('company', function ($query) use ($searchQuery) {
                                    $query->where('name', 'like', "%$searchQuery%")
                                        ->orWhere('kvknumber', 'like', "%$searchQuery%")
                                        ->orWhere('btwnumber', 'like', "%$searchQuery%");
                                });
                        });
                    })->orWhereHas('vehicle', function ($query) use ($searchQuery) {
                        $query->where('vehicle_name', 'like', "%$searchQuery%");
                    });
                })
                ->with(['user.address', 'user.company', 'vehicle', 'dates'])->withTrashed()->get();

            $guestReservations = Reservation::where('auth_type', 'Guest')->where(function ($query) use ($searchQuery) {
                $query->whereHas("guestUser", function ($query) use ($searchQuery) {
                    $query->where(function ($query) use ($searchQuery) {
                        $query->where(DB::raw("CONCAT(firstname, ' ', lastname)"), 'like', "%$searchQuery%")
                            ->orWhere('email', 'like', "%$searchQuery%")
                            ->orWhere('phonenumber', 'like', "%$searchQuery%")
                            ->orWhereHas('address', function ($query) use ($searchQuery) {
                                $query->where('streetname', 'like', "%$searchQuery%")
                                    ->orWhere('housenumber', 'like', "%$searchQuery%")
                                    ->orWhere('postalcode', 'like', "%$searchQuery%");
                            })->orWhereHas('company', function ($query) use ($searchQuery) {
                                $query->where('companyname', 'like', "%$searchQuery%")
                                    ->orWhere('kvknumber', 'like', "%$searchQuery%");
                            });
                    });
                })->orWhereHas('vehicle', function ($query) use ($searchQuery) {
                    $query->where('vehicle_name', 'like', "%$searchQuery%");
                });
            })->with(['guestUser.address', 'guestUser.company', 'vehicle', 'dates'])->withTrashed()->get();

            $occasionsReservations = OccasionsReservation::where(function ($query) use ($searchQuery) {
                $query->whereHas("guestUser", function ($query) use ($searchQuery) {
                    $query->where(function ($query) use ($searchQuery) {
                        $query->where(DB::raw("CONCAT(firstname, ' ', lastname)"), 'like', "%$searchQuery%")
                            ->orWhere('email', 'like', "%$searchQuery%")
                            ->orWhere('phonenumber', 'like', "%$searchQuery%")
                            ->orWhereHas('address', function ($query) use ($searchQuery) {
                                $query->where('streetname', 'like', "%$searchQuery%")
                                    ->orWhere('housenumber', 'like', "%$searchQuery%")
                                    ->orWhere('postalcode', 'like', "%$searchQuery%");
                            })->orWhereHas('company', function ($query) use ($searchQuery) {
                                $query->where('companyname', 'like', "%$searchQuery%")
                                    ->orWhere('kvknumber', 'like', "%$searchQuery%");
                            });
                    });
                });
            })->with(['guestUser.address', 'guestUser.company'])->withTrashed()->get();

            $reservations = $authReservations->concat($guestReservations)->concat($occasionsReservations)->toArray();

            $sortedReservations = collect($reservations)->sortBy(function ($reservation) {
                $startDate = isset($reservation["dates"]["startDate"]) ? new DateTime($reservation["dates"]["startDate"]) : new DateTime($reservation["created_at"]);
                return ($startDate >= new DateTime()) ? 0 : $startDate->diff(new DateTime())->days;
            })->toArray();

            $pages = array_chunk($sortedReservations, 15);

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

    public function store(CreateReservationRequest $request)
    {
        try {
            $validation = $request->validated();

            $vehicle = Vehicle::find($request->vehicleId);

            if (empty($vehicle)) {
                throw new Exception("Vehicle niet gevonden!");
            }

            $startDate = Carbon::createFromFormat("d/m/Y", $request->startDate)->timezone("Europe/Amsterdam");

            if (!$startDate) {
                throw new Exception("Opgeven start datum is niet geldig!");
            }

            if (!$startDate->greaterThanOrEqualTo(Carbon::tomorrow())) {
                throw new Exception("Start datum mag niet voor " . Carbon::tomorrow()->format("d/m/Y") . " zijn");
            }

            $endDate = Carbon::createFromFormat("d/m/Y", $request->endDate)->timezone("Europe/Amsterdam");

            if (!$endDate) {
                throw new Exception("Opgeven eind datum is niet geldig!");
            }

            if (!$endDate->greaterThanOrEqualTo($startDate)) {
                throw new Exception("Eind datum mag niet voor " . $startDate->addDay()->format("d/m/Y") . " zijn");
            }

            $duration = CarbonPeriod::create($startDate, $endDate)->count();

            $reservations = ReservationDate::where('startDate', '<=', $endDate)
                ->where('endDate', '>=', $startDate)
                ->orWhere(function ($query) use ($startDate, $endDate) {
                    $query->where('startDate', '>=', $startDate)
                        ->where('startDate', '<=', $endDate)
                        ->orWhere('endDate', '>=', $startDate)
                        ->where('endDate', '<=', $endDate);
                })
                ->get()->toArray();

            $amount = $this->fetchReservationsVehicleCounts($reservations);

            if ($vehicle->stock - $amount < $request->amount) {
                throw new Exception("Er zijn nog maximaal: " . $vehicle->stock - $amount . " machines beschikbaar!");
            }

            $user = GuestUser::find($this->getUsersAccountId($request));

            if (!$this->createReservation($user->id, $request, $duration, $user)) {
                throw new Exception("Er is iets fout gegaan bij het aanmaken van de reservering, probeer het later opnieuw!");
            }

            return response()->json(["message" => "Reservering is succesvol aangemaakt!"], 200);
        } catch (Exception $e) {
            Log::emergency("ReservationController", [
                "error" => $e->getMessage(),
                "request" => $request->toArray(),
            ]);

            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    public function storeOccasions(CreateOccasionsReservationRequest $request)
    {
        try {
            $validation = $request->validated();

            $user = $this->createGuestUser($request->user);

            if (!$user) {
                return log_and_return_error(request(), 'Probeer het later opnieuw!');
            }

            if (!$this->createOccasionsReservation($request, $user)) {
                throw new Exception("Er is iets fout gegaan bij het aanmaken van de reservering, probeer het later opnieuw!");
            }

            return response()->json(["message" => "Reservering is succesvol aangemaakt!"], 200);
        } catch (Exception $e) {
            Log::emergency("ReservationController", [
                "error" => $e->getMessage(),
                "action" => "StoreOccasions",
                "request" => $request->toArray(),
            ]);

            return response()->json(["message" => $e->getMessage()], 500);
        }
    }

    private function createOccasionsReservation($reservation, $user)
    {
        try {
            $distance = $this->fetchDistanceFromPostalCode(preg_replace('/\s/', '', $reservation["user"]["postalcode"]));

            $newReservation = OccasionsReservation::create([
                "dealer_id" => $user->id,
                "auth_type" => "Guest",
                "vehicle_name" => $reservation["vehicle"]["name"],
                "vehicle_image" => $reservation["vehicle"]["image"],
                "vehicle_price" => preg_replace('/[^0-9]/', '', $reservation["vehicle"]["price"]),
                "vehicle_url" => $reservation["vehicle"]["url"],
                "distance" => round($distance),
            ]);

            $this->sendOccasionsReservationAcceptedMail($reservation["vehicle"]["name"], $user["email"]);

            return true;
        } catch (Exception $e) {
            Log::emergency("ReservationController", [
                "action" => "createReservation",
                "error" => $e->getMessage(),
            ]);
            return false;
        }
    }

    private function createGuestUser($data)
    {
        try {
            $explodedName = explode(' ', $data["name"]);
            $firstname = array_shift($explodedName);
            $lastname = implode(' ', $explodedName);

            $user = GuestUser::create([
                'firstname' => $firstname,
                'lastname' => $lastname ?? '.',
                'email' => $data["email"],
                'phonenumber' => $data["phonenumber"],
            ]);

            $userAddress = GuestUserAddress::create([
                'country' => $data["country"],
                'city' => $data["city"],
                'streetname' => $data["streetname"],
                'housenumber' => $data["housenumber"],
                'postalcode' => $data["postalcode"],
                'guest_user_id' => $user->id,
            ]);

            if (!is_null($data["company"]["name"]) && !is_null($data["company"]["kvknumber"])) {
                $userCompany = GuestUserCompany::create([
                    'companyname' => $data["company"]["name"],
                    'kvknumber' => $data["company"]["kvknumber"],
                    'guest_user_id' => $user->id,
                ]);
            }

            return $user;
        } catch (Exception $e) {
            return log_and_return_error(request(), $e->getMessage());
        }
    }

    private function createReservation(string $id, object $request, $duration, $user)
    {
        try {
            $distance = $this->fetchDistanceFromPostalCode(preg_replace('/\s/', '', $request->user["postalcode"]));

            $newReservation = Reservation::create([
                "dealer_id" => $id,
                "auth_type" => "Guest",
                "vehicle_id" => $request->vehicleId,
                // "distance" => $this->categorizeDistance(round($distance)),
                "distance" => round($distance),
                "amount" => $request->amount,
                "duration" => $this->convertToYWD($duration),
            ]);

            $startDate = Carbon::createFromFormat("d/m/Y", $request->startDate)->timezone("Europe/Amsterdam");
            $endDate = Carbon::createFromFormat("d/m/Y", $request->endDate)->timezone("Europe/Amsterdam");

            $newReservationDate = ReservationDate::create([
                "reservation_id" => $newReservation->id,
                "startDate" => $startDate,
                "endDate" => $endDate,
            ]);

            $vehicleName = Vehicle::find($request->vehicleId)->first()->toArray()["vehicle_name"];

            $this->sendReservationAcceptedMail($vehicleName, $startDate, $endDate, $user->email);

            return true;
        } catch (Exception $e) {
            Log::emergency("ReservationController", [
                "action" => "createReservation",
                "error" => $e->getMessage(),
            ]);
            return false;
        }
    }

    private function convertToYWD($days)
    {
        // Calculate the number of years
        $years = floor($days / 365);

        // Calculate the number of weeks
        $weeks = floor(($days % 365) / 7);

        // Calculate the number of days
        $days = $days - ($years * 365) - ($weeks * 7);

        // Return the number of years, weeks, and days
        return "$years y $weeks w $days d";
    }

    private function fetchDistanceFromPostalCode(string $postalCode)
    {
        $postalCodeCoords = PostalcodeCoord::where("postal_code",  $postalCode)->first();
        $homePostalCode = PostalcodeCoord::where("postal_code", SettingsController::fetchSetting("homePostalCode"))->first();

        if (empty($homePostalCode)) {
            Log::emergency("home postalcode not found", [
                "controller" => "reservationController"
            ]);

            return 0;
        }


        if (!empty($postalCodeCoords)) {
            return $this->calculateDistanceByLatLng($homePostalCode, [
                "lat" => $postalCodeCoords->lat,
                "long" => $postalCodeCoords->lon,
            ]);
        }

        $response = $this->crawlOpenStreetMap("https://nominatim.openstreetmap.org/search.php?q=" . $postalCode . "&format=jsonv2");

        $newPostalCodeStatus = $this->createNewPostalCoords($response, $postalCode);

        if (!$newPostalCodeStatus) {
            return 0;
        }

        return $this->calculateDistanceByLatLng($homePostalCode, [
            "lat" => $response["lat"],
            "long" => $response["lon"],
        ]);
    }

    private function createNewPostalCoords($response, string $postalCode)
    {
        try {
            $newPostalCoords = PostalcodeCoord::create([
                "postal_code" => $postalCode,
                "lat" => $response["lat"],
                "long" => $response["lon"],
            ]);

            return true;
        } catch (Exception $e) {
            Log::emergency("ReservationController", [
                "error" => $e->getMessage(),
                "response" => $response,
                "postalCode" => $postalCode,
            ]);

            return false;
        }
    }

    private function crawlOpenStreetMap(string $url)
    {
        $userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $html = curl_exec($ch);
        if (!$html) {
            return null;
        } else {
            return json_decode($html, true)[0] ?? null;
        }
    }

    private function calculateDistanceByLatLng($homePostalCode, $postalCodeCoords)
    {
        $lat1 = deg2rad($homePostalCode->lat);
        $lng1 = deg2rad($homePostalCode->long);
        $lat2 = deg2rad($postalCodeCoords["lat"]);
        $lng2 = deg2rad($postalCodeCoords["long"]);

        // Calculate the distance using the Haversine formula
        $earth_radius = 6371;
        $distance = $earth_radius * acos(cos($lat1) * cos($lat2) * cos($lng1 - $lng2) + sin($lat1) * sin($lat2));

        return $distance;
    }

    private function sendOccasionsReservationAcceptedMail($vehicleName, $to)
    {
        $time = new DateTime('now', new DateTimeZone('Europe/Amsterdam'));

        $details = [
            "vehicle" => $vehicleName,
            "currentTime" => $time->format("F j, Y, g:i a"),
        ];

        try {
            Mail::to($to)->send(new OccasionsReservationMail($details));
        } catch (Exception $e) {
            Log::emergency("ContactController", [
                "action" => "submitRequest",
                "error" => $e->getMessage(),
                "to_email_address" => $to,
            ]);
        }
    }

    private function sendReservationAcceptedMail($vehicleName, $startDate, $endDate, $to)
    {
        $time = new DateTime('now', new DateTimeZone('Europe/Amsterdam'));

        $details = [
            "vehicle" => $vehicleName,
            "startDate" => $startDate,
            "endDate" => $endDate,
            "currentTime" => $time->format("F j, Y, g:i a"),
        ];

        try {
            Mail::to($to)->send(new ReservationMail($details));
        } catch (Exception $e) {
            Log::emergency("ContactController", [
                "action" => "submitRequest",
                "error" => $e->getMessage(),
                "to_email_address" => $to,
            ]);
        }
    }

    private function getUsersAccountId(object $request)
    {
        try {
            if (isset($request->user["name"])) {
                $explodedName = explode(' ', $request->user["name"]);
                $firstname = array_shift($explodedName);
                $lastname = implode(' ', $explodedName);
            } else {
                $firstname = $request->user["firstname"];
                $lastname = $request->user["lastname"];
            }

            $newGuestUser = GuestUser::create([
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $request->user["email"],
                "phonenumber" => $request->user["phonenumber"],
            ]);

            $newGuestUserAddress = GuestUserAddress::create([
                "country" => $request->user["country"],
                "city" => $request->user["city"],
                "streetname" => $request->user["streetname"],
                "housenumber" => $request->user["housenumber"],
                "postalcode" => $request->user["postalcode"],
                "guest_user_id" => $newGuestUser->id,
            ]);

            if (!empty($request->user["company"]["name"]) && !empty($request->user["company"]["kvknumber"])) {
                $newGuestUserCompany = GuestUserCompany::create([
                    "companyname" => $request->user["company"]["name"],
                    "kvknumber" => $request->user["company"]["kvknumber"],
                    "guest_user_id" => $newGuestUser->id,
                ]);
            }

            return $newGuestUser->id;
        } catch (Exception $e) {
            return log_and_return_error(request(), $e->getMessage());
        }
    }

    private function fetchReservationsVehicleCounts(array $items)
    {
        return collect($items)->map(function ($item) {
            return Reservation::find($item["reservation_id"]);
        })->filter()->sum("amount");
    }

    public function acceptOccasions($id)
    {
        try {
            $reservation = OccasionsReservation::withTrashed()->find($id);

            $reservation->fill([
                "status" => Carbon::now(),
                "deleted_at" => null
            ])->save();

            return response()->json(["message" => "Reservering succesvol geaccepteerd"], 200);
        } catch (Exception $e) {
            return log_and_return_error(request(), $e->getMessage());
        }
    }

    public function accept($id)
    {
        try {
            $reservation = Reservation::withTrashed()->find($id);

            $reservation->fill([
                "status" => Carbon::now(),
                "deleted_at" => null
            ])->save();

            return response()->json(["message" => "Reservering succesvol geaccepteerd"], 200);
        } catch (Exception $e) {
            return log_and_return_error(request(), $e->getMessage());
        }
    }

    public function deleteOccasions($id)
    {
        try {
            OccasionsReservation::find($id)->delete();

            return response()->json(["message" => "Reservering succesvol afgewezen"], 200);
        } catch (Exception $e) {
            return log_and_return_error(request(), $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            Reservation::find($id)->delete();

            return response()->json(["message" => "Reservering succesvol afgewezen"], 200);
        } catch (Exception $e) {
            return log_and_return_error(request(), $e->getMessage());
        }
    }
}
