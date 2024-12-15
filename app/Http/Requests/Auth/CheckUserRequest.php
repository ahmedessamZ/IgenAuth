<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CheckUserRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'country_code' => 'required|numeric|max:99999',
            'phone' => 'required|numeric|max:999999999999999999999999999999',
        ];
    }
}

