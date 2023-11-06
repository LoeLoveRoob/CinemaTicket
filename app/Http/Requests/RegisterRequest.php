<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "phone"=> ["required", "integer", "min:11"],
            "password"=> ["required", "string", "min:8", "confirmed"],
            "password_confirmation"=> ["required", "string", "min:8"],
            "name"=> ["string", "min:3"],
            "family"=> ["string", "min:3"],
            "birth"=> "",
        ];
    }
}
