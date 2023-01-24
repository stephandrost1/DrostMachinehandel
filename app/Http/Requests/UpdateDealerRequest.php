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
            "btwnumber" => "required|min:14",
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
        ];
    }

    public function messages()
    {
        return [];
    }
}
