<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsersPostRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required'],
            'gender' => ['required'],
            'password' => ['required_with:password_confirmation', 'same:password_confirmation'],
            'password_confirmation' => ['required'],
            'birth_day' => ['required'],
            'avatar' => ['required'],
            'mobile' => ['required', 'min:4'],
            'national_id' => ['required']

        ];
    }
}
