<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDealerRequest extends FormRequest
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
            "id" => "required",
            "firstname" => "required",
            "lastname" => "required",
            "email" => "required|email",
            "phonenumber" => "required|min:10",
            "companyname" => "required",
            "kvknumber" => "required|regex:/^(\d{8})$/",
            "email_verified_at" => "required",
        ];
    }

    public function messages()
    {
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
            "kvknumber.regex" => "Het opgegeven kvk nummer is niet geldig!",
            "email_verified_at.required" => "Handelaar account status niet gevonden!",
        ];
    }
}
