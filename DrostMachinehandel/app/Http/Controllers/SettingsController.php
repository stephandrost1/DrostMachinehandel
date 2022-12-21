<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingsController extends Controller
{
    public static function fetchSetting($sQuery)
    {
        try {
            $setting = Setting::where("name", $sQuery)->get()->first();

            if (empty($setting)) {
                Log::error("Unknow setting :" . $sQuery);
                return null;
            }

            return $setting->value;
        } catch (Exception $e) {
            Log::emergency("fetchSetting", [
                "error" => $e->getMessage()
            ]);
        }
    }

    public static function setSetting($sQuery, $sValue)
    {
        try {
            $setting = Setting::updateOrCreate([
                [
                    'name' => $sQuery,
                    'value' => $sValue,
                ],
                [
                    'name' => $sQuery,
                    'value' => $sValue,
                ]
            ]);
        } catch (Exception $e) {
            Log::emergency("setSetting", [
                "error" => $e->getMessage()
            ]);
        }
    }
}
