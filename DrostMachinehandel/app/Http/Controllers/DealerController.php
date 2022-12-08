<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDealerRequest;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function create(CreateDealerRequest $request)
    {
        $validated = $request->validated();

        dd(collect($request)->toArray());

        return response()->json(["good" => "yes"]);
    }
}
