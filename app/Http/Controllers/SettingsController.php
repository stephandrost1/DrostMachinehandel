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
                throw new Exception("Unknow setting : " . $sQuery);
            }

            return $setting->value;
        } catch (Exception $e) {
            Log::emergency("fetchSetting", [
                "error" => $e->getMessage()
            ]);
        }
    }

    public static function fetchSettings($sQuery): array
    {
        try {
            $settings = Setting::where("name", $sQuery)->pluck("value")->toArray();

            return $settings;
        } catch (Exception $e) {
            Log::emergency("fetchSettings", [
                "error" => $e->getMessage()
            ]);
        }
    }

    public static function setSetting($sQuery, $sValue)
    {
        try {
            $setting = Setting::firstOrCreate([
                'name' => $sQuery,
                'value' => $sValue,
            ]);
        } catch (Exception $e) {
            Log::emergency("setSetting", [
                "error" => $e->getMessage()
            ]);
        }
    }
}
