<?php

namespace App\Http\Controllers;

use App\Models\RentFilter;
use Exception;

class FilterController extends Controller
{
    public function index()
    {
        $filters = RentFilter::with("options")->get();

        return response()->json(["filters" => $filters, "results" => count($filters) > 0]);
    }
}
