<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public static function fetchSetting($sQuery)
    {
        $setting = Setting::where("name", $sQuery)->get()->first();

        return $setting->value;
    }
}
