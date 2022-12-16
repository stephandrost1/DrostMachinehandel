<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Exception;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index($pageId, Request $request)
    {
        try {
            $searchQuery = '%' . $request->s . '%';

            $reservations = Reservation::with("dealer.address", "vehicle")->get()->toArray();

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
}
