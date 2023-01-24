<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateMaintenanceVehicleRequest extends FormRequest
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
            'vehicle_name' => 'required',
            'mark' => 'required',
            'type' => 'required',
            'serial_number' => 'required',
            'construction_year' => 'required',
            'reference_number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'vehicle_name.required' => 'Het veld naam is verplicht!',
            'mark' => 'Het veld merk is verplicht!',
            'type' => 'Het veld type is verplicht!',
            'serial_number' => 'Het veld serienummer is verplicht!',
            'construction_year' => 'Het veld bouwjaar is verplicht!',
            'reference_number' => 'Het veld referentienummer is verplicht!',
        ];
    }
}
