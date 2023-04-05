<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ["required", "max:255"],
            'email' => ["required", "max:255", "unique:users,email"],
            'password' => ["required", "max:255", "min:6"],
            'national_id' => ["required", "max:14", "unique:users,national_id"],
            'avatar_image' => ["nullable", "mimes:jpg,png", "size:4096"],
            'gender' => ["required"],
            'mobile' => ["required", "digits:11"],
            'date_of_birth' => ["required", "date"],
            'name' => ["required", "max:255"],
            'area_id' => ["required"],
            'priority' => ["required","min:1"]
        ];
    }
}
