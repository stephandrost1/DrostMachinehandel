<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateMaintenanceVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = User::find(Auth::id());

        return Auth::check() && $user->hasRole(["Admin"]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'vehicle_name' => "required",
            'mark' => "required",
            'type' => "required",
            'construction_year' => "required",
            'serial_number' => "required",
            'reference_number' => "required",
        ];
    }

    public function messages()
    {
        return [
            'vehicle_name.required' => "Het veld naam is verplicht!",
            'mark.required' => "Het veld merk is verplicht!",
            'type.required' => "Het veld type is verplicht!",
            'construction_year.required' => "Het veld bouwjaar is verplicht!",
            'serial_number.required' => "Het veld serienummer is verplicht!",
            'reference_number.required' => "Het veld referentienummer is verplicht!",
        ];
    }
}
