<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phonenumber' => 'required',
            'password' => 'required|min:8',
            'password-repeat' => 'required|same:password',
            'country' => 'required',
            'province' => 'required',
            'city' => 'required',
            'streetname' => 'required',
            'housenumber' => 'required',
            'postalcode' => 'required|regex:^([1-9][0-9]{3}\s?[a-zA-Z]{2})|([1-9]{1}[0-9]{3})|([0-9]{5})|((([Gg][Ii][Rr] 0[Aa]{2})|((([A-Za-z][0-9]{1,2})|(([A-Za-z][A-Ha-hJ-Yj-y][0-9]{1,2})|(([A-Za-z][0-9][A-Za-z])|([A-Za-z][A-Ha-hJ-Yj-y][0-9]?[A-Za-z]))))\s?[0-9][A-Za-z]{2}))$',
            'companyname' => 'required',
            'kvknumber' => 'required|unique:user_companies',
            'btwnumber' => 'required|unique:user_companies',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Het voornaam veld is verplicht!',
            'firstname.string' => 'Het voornaam veld mag geen nummbers bevatten!',
            'firstname.max' => 'Het voornaam veld mag niet langer dan 255 karakters zijn',
            'lastname.required' => 'Het voornaam veld is verplicht!',
            'lastname.string' => 'Het voornaam veld mag geen nummbers bevatten!',
            'lastname.max' => 'Het voornaam veld mag niet langer dan 255 karakters zijn',
            'email.required' => 'Het e-mailadres veld is verplicht!',
            'email.email' => 'Het opgegeven e-mailadres is niet geldig!',
            'email.unique' => 'Het opgegeven e-mailadres is al in gebruik!',
            'phonenumber.required' => 'Het telefoonnummer veld is verplicht!',
            'password.required' => 'Het wachtwoord veld is verplicht!',
            'password.min' => 'Opgegeven wachtwoord is te kort, minimaal 8 karakters!',
            'password-repeat.required' => 'Het wachtwoord veld is verplicht!',
            'password-repeat.same' => 'Opgegeven wachtwoorden komen niet overeen!',
            'country.required' => 'Het land veld is verplicht!',
            'province.required' => 'Het provincie veld is verplicht!',
            'city.required' => 'Het woonplaats veld is verplicht!',
            'streetname.required' => 'Het straatnaam veld is verplicht!',
            'housenumber.required' => 'Het huisnummer veld is verplicht!',
            'postalcode.required' => 'Het postcode veld is verplicht!',
            'companyname.required' => 'Het bedrijfsnaam veld is verplicht!',
            'kvknumber.required' => 'Het kvknummer veld is verplicht!',
            'btwnumber.required' => 'Het btwnummer veld is verplicht!',
        ];
    }
}
