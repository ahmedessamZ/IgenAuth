<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'avatar' => 'nullable|string|max:255',
            'country_code' => 'required|numeric|max:99999',
            'phone' => 'required|numeric|unique:users,phone|max:999999999999999999999999999999',
        ];
    }

}
