<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditMaintenanceActionRequest extends FormRequest
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
            'activity' => "required"
        ];
    }

    public function messages()
    {
        return [
            'activity.required' => "De activiteit mag niet leeg zijn!",
        ];
    }
}
