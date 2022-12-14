<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
            'name' => 'required|min:1|max:255',
            'description' => 'required|min:1',
            'pricePerDay' => 'required|min:1|numeric',
            'pricePerWeek' => 'required|min:1|numeric',
            'specifications' => 'sometimes|present|array',
            'activeTags' => 'sometimes|present|array',
            'tags' => 'sometimes|present|array',
            'images' => 'sometimes|present|array',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Machine id niet gevonden!',
            'name.required' => 'Het veld "Naam" is leeg!',
            'name.min' => 'Het veld "Naam" is leeg!',
            'name.max' => 'Het veld "Naam" mag niet langer zijn dan 255 karakters!',
            'description.required' => 'Het veld "Beschrijving" is leeg!',
            'description.min' => 'Het veld "Beschrijving" is leeg!',
            'pricePerDay.required' => 'Het veld "Prijs per dag" is leeg!',
            'pricePerDay.min' => 'Het veld "Prijs per dag" moet minimaal 1 zijn!',
            'pricePerDay.numeric' => 'Het veld "Prijs per dag" moet een getal zijn!',
            'pricePerWeek.required' => 'Het veld "Prijs per week" is leeg!',
            'pricePerWeek.min' => 'Het veld "Prijs per week" moet minimaal 1 zijn!',
            'pricePerWeek.numeric' => 'Het veld "Prijs per week" moet een getal zijn!',
            'specifications.required' => 'Probeer het later opnieuw!',
            'tags.required' => 'Probeer het later opnieuw!',
            'activeTags.required' => 'Probeer het later opnieuw!',
            'images.required' => 'Probeer het later opnieuw!'
        ];
    }
}
