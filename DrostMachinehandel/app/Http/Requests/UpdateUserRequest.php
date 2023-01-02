<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:8',
            'passwordRepeat' => 'nullable|same:password',
            'currentPassword' => 'required'
        ];
    }

    public function messages()
    {
        return [
            "id.required" => "Gebruikers id niet gevonden!",
            "name.required" => "Het veld naam is leeg!",
            "name.max" => "Het veld naam kan maximaal 255 karakters bevatten",
            "email.required" => "Het veld E-mailadres is leeg!",
            "email.email" => "Het veld E-mailadres is niet geldig!",
            "email.unique" => "Het opgegeven E-mailadres is al in gebruik!",
            "password.min" => "Het opgegeven wachtwoord is te kort, minimaal 8 karakters",
            "passwordRepeat.same" => "De opgegeven wachtwoorden komen niet overeen!",
            "passwordCurrent.required" => "Het opgegeven huidige wachtwoord is niet correct!",
        ];
    }
}
