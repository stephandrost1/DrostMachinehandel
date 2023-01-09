<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (User::find(Auth::id())->hasRole(["Admin"])) {
            return [
                'id' => 'required',
                'name' => 'required|max:255',
                'email' => 'required|email',
                'password' => 'nullable|min:8',
                'passwordRepeat' => 'nullable|same:password',
                'currentPassword' => 'required'
            ];
        }

        return [
            "id" => "required",
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required|email",
            "phonenumber" => "required|min:10",
            "email_verified_at" => "nullable",
            "password" => "nullable",
            "passwordRepeat" => "nullable|same:password",
            "currentPassword" => "nullable",
            "address" => "array",
            "address.postalcode" => "required",
            "address.city" => "required|min:1",
            "address.country" => "required|min:1",
            "address.housenumber" => "required|min:1",
            "address.streetname" => "required|min:3",
            "address.province" => "required|min:3",
            "company.companyname" => "required",
            "company.kvknumber" => "required|regex:/^(\d{8})$/",
            "company.btwnumber" => "required|min:14",
        ];
    }

    public function messages()
    {
        if (User::find(Auth::id())->hasRole(["Admin"])) {
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

        return [
            "id.required" => "Handelaar id niet gevonden!",
            "firstname.required" => "Het voornaam veld is leeg!",
            "lastname.required" => "Het achternaam veld is leeg!",
            "email.required" => "Het E-mailadres veld is leeg!",
            "email.email" => "Opgegeven E-mailadres is niet geldig",
            "phonenumber.required" => "Het voornaam veld is leeg!",
            "phonenumber.min" => "Het opgegeven telefoonnummer is niet geldig!",
            "companyname.required" => "Het bedrijfsnaam veld is leeg!",
            "kvknumber.required" => "Het kvk nummer veld is leeg!",
            "btwnumber.required" => "Het btw nummer veld is leeg!",
            "kvknumber.regex" => "Het opgegeven kvk nummer is niet geldig!",
            "btwnumber.regex" => "Het opgegeven btw nummer is niet geldig!",
            "email_verified_at.required" => "Handelaar account status niet gevonden!",
            "passwordRepeat.same" => "Opgegeven wachtwoorden komen niet overeen!",
        ];
    }
}
