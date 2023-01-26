<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class createVehicleRequest extends FormRequest
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
            'name' => 'required|min:1|max:255',
            'description' => 'required|min:1',
            'pricePerDay' => 'required|numeric',
            'pricePerWeek' => 'required|numeric',
            'stock' => 'required|min:0|numeric',
            'specifications' => 'sometimes|present|array',
            'activeTags' => 'sometimes|present|array',
            'tags' => 'sometimes|present|array',
            'images' => 'sometimes|present|array',
        ];
    }

    public function messages()
    {
        return [
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
            'stock.numeric' => 'Het veld "Aantal beschikbaar" moet een getal zijn!',
            'stock.min' => 'Het veld "Aantal beschikbaar" moet minimaal 0 zijn!',
            'stock.required' => 'Het veld "Aantal beschikbaar" is leeg!',
            'specifications.required' => 'Probeer het later opnieuw!',
            'tags.required' => 'Probeer het later opnieuw!',
            'activeTags.required' => 'Probeer het later opnieuw!',
            'images.required' => 'Probeer het later opnieuw!'
        ];
    }
}
