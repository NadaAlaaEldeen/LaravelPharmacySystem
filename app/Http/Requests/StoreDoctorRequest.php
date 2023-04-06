<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|min:5',
            'email'=> 'unique:App\User,email|email|required',
            'password'=> 'required|min:6',
            'national_id'=> 'required|unique:App\Doctor,national_id|min:10',
            //'pharmacy_id'=> 'exists:pharmacies,id',
            'avatar'=> 'image|mimes:jpeg,jpg,png'
        ];
    }
}
