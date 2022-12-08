<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDealerRequest extends FormRequest
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
            "firstname" => "required|min:1",
            "lastname" => "required|min:1",
            "email" => "required|min:1",
            "phonenumber" => "required|min:1",
            "companyname" => "required|min:1",
            "kvknumber" => "required|min:1",
            "password" => "required|min:1",
            "password-repeat" => "required|min:1",
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Het veld voornaam is leeg!',
            'lastname.required' => 'Het veld voornaam is leeg!',
            'email.required' => 'Het veld e-mailadres is leeg!',
            'phonenumber.required' => 'Het veld telefoonnummer is leeg!',
            'companyname.required' => 'Het veld bedrijfsnaam is leeg!',
            'kvknumber.required' => 'Het veld kvk-nummer is leeg!',
            'password.required' => 'Het veld wachtwoord is leeg!',
            'password-repeat.required' => 'Het veld wachtwoord herhalen is leeg!'
        ];
    }
}
