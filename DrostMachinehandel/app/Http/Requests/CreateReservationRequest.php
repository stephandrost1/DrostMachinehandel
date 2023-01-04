<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateReservationRequest extends FormRequest
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
            'vehicleId' => 'required',
            'amount' => 'required|numeric',
            'startDate' => 'required|date|after:' . Carbon::now()->addDays(2)->format('d/m/Y') . '|date_format:d/m/Y',
            'endDate' => 'required|date|after_or_equal:startDate|date_format:d/m/Y',
            'user' => 'array',
            'user.firstname' => 'required',
            'user.insertion' => 'nullable',
            'user.lastname' => 'required',
            'user.email' => 'required|email',
            'user.phonenumber' => 'required|regex:/^[0-9]{10}$/',
            'user.streetname' => 'required',
            'user.housenumber' => 'required',
            'user.postalcode' => 'required|regex:/^[0-9]{4}[a-zA-Z]{2}$/',
            'user.city' => 'required',
            'user.country' => 'required',
            'user.company' => 'nullable|array',
            'user.company.name' => 'nullable',
            'user.company.kvknumber' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'vehicleId.required' => 'Machine indificator niet gevonden!',
            'amount.required' => 'Er is geen geldig aantal machines gevonden!',
            'amount.numeric' => 'Het aantal machines moet een cijfer zijn!',
            'startDate.required' => 'Er is geen startdatum ingevuld!',
            'startDate.date' => 'Er is geen geldige startdatum ingevuld!',
            'startDate.after' => 'De startdatum mag niet eerder dan ' . Carbon::now()->addDays(2)->format('d/m/Y') . ' zijn',
            'endDate.required' => 'Er is geen einddatum ingevuld!',
            'endDate.date' => 'Er is geen geldige einddatum ingevuld!',
            'endDate.after' => 'De einddatum mag niet eerder dan de startdatum zijn',
            'user.firstname.required' => 'Het veld voornaam mag niet leeg zijn!',
            'user.lastname.required' => 'Het veld achternaam mag niet leeg zijn!',
            'user.email.required' => 'Het veld E-mailadres mag niet leeg zijn!',
            'user.email.email' => 'Het veld E-mailadres is niet geldig!',
            'user.phonenumber.required' => 'Het veld telefoonnummer mag niet leeg zijn!',
            'user.phonenumber.regex' => 'Het opgegeven telefoonnummer is niet geldig!',
            'user.streetname.required' => 'Het veld straat & huisnummer mag niet leeg zijn!',
            'user.housenumber.required' => 'Er is geen huisnummer opgegeven!',
            'user.postalcode.required' => 'Het veld postcode mag niet leeg zijn!',
            'user.postalcode.regex' => 'De opgegeven postcode is niet correct, voorbeeld: 1000AA!',
            'user.city.required' => 'Het veld woonplaats mag niet leeg zijn!',
            'user.country.required' => 'Het veld land mag niet leeg zijn!',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.*
     * @return array
     */
    protected function failedValidation(ValidationValidator  $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => collect($validator->errors())->first()[0],
            'status' => true
        ], 422));
    }
}
