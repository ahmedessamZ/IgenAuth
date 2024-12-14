<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'country_code' => 'required|numeric',
            'phone' => 'required|numeric',
            'otp' => 'required|numeric',
        ];
    }

}