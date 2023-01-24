<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateMaintenanceActionRequest extends FormRequest
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
            "vehicle_id" => "required",
            "activity" => "string|required",
        ];
    }

    public function messages()
    {
        return [
            "vehicle_id.required" => "Probeer het later opnieuw!",
            "activity.string" => "De ingevulde activiteit is niet geldig!",
            "activity.required" => "Er is geen activiteit opgegeven!",
        ];
    }
}
