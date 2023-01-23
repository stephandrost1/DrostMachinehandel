<?php

use Illuminate\Support\Facades\Log;

function log_and_return_error($request,  $error_message)
{
    list($controller, $action) = explode("@", $request->route()->action["controller"]);
    $controller = class_basename($controller);

    Log::emergency($controller, [
        "action" => $action,
        "error" => $error_message
    ]);
    return response()->json(["message" => "Er is iets fout gegaan: " . $error_message], 500);
}
