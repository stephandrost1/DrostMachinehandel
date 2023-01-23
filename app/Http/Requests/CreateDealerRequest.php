<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

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
            "email" => "required|email|unique:Dealers|",
            "phonenumber" => "required|min:10|numeric",
            "companyname" => "required",
            "kvknumber" => "required|min:8|numeric",
            "password" => [
                'required',
                'string',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            "password-repeat" => "required|min:8|same:password",
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Het veld voornaam is leeg!',
            'lastname.required' => 'Het veld voornaam is leeg!',
            'email.required' => 'Het veld e-mailadres is leeg!',
            'email.email' => 'Het opgegeven e-mailadres is niet geldig',
            'email.unique' => 'Het opgegeven e-mailadres is alreeds in gebruik',
            'phonenumber.required' => 'Het veld telefoonnummer is leeg!',
            'phonenumber.min' => 'Het opgegeven telefoonnummer is niet geldig',
            'phonenumber.numeric' => 'Het opgegeven telefoonnummer is niet geldig',
            'companyname.required' => 'Het veld bedrijfsnaam is leeg!',
            'kvknumber.required' => 'Het veld kvk-nummer is leeg!',
            'kvknumber.min' => 'Het opgegeven kvk-nummer is niet geldig',
            'kvknumber.numeric' => 'Het opgegeven kvk-nummer is niet geldig',
            'password.regex' => 'Uw wachtwoord moet minimaal 1 hoofdletter, 1 kleine letter, 1 cijfer en 1 teken bevatten!',
            'password.min' => 'Uw wachtwoord moet minimaal 8 tekens bevatten',
            'password.required' => 'Het veld wachtwoord is leeg!',
            'password-repeat.required' => 'Het veld wachtwoord herhalen is leeg!',
            'password-repeat.same' => 'Wachtwoorden komen niet overeen!'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.*
     * @return array
     */
    protected function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => implode(' ', collect($validator->errors())->first()),
            'status' => true
        ], 422));
    }
}
