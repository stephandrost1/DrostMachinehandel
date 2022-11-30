<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class VehicleImagesController extends Controller
{
    public function create(Request $request)
    {
        if (is_null($request->file) || is_null($request->vehicleId)) {
            return response()->json(["message" => "missing file"], 400);
        }

        try {
            $file = $request->file("file");
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = str_replace("." . $fileExtension, "", $this->generateUniqueFilename($file));
            $file->move(base_path("/public/vehicles/" . $request->vehicleId), $fileName . "." . $fileExtension);
        } catch (Exception $e) {
            return response()->json(["message" => "something went wrong: " . $e->getMessage()], 400);
        }

        return response()->json(["message" => "succes", "fileName" => $fileName, "fileExtension" => $fileExtension], 200);
    }

    public function generateUniqueFilename(UploadedFile $file): string
    {
        if (empty($file)) {
            return "";
        }

        $fileExtension = $file->getClientOriginalExtension();

        return md5(date('Y-m-d H:i:s:u')) . "." . $fileExtension;
    }
}
