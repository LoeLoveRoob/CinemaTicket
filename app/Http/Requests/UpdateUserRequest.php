<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "phone"=> ["integer", "unique:user,phone", "min:11"],
            "name"=> ["string", "min:3"],
            "family"=> ["string", "min:3"],
            "birth"=> ["date"],
            "email"=> ["string", "unique:users,email"],
            "password"=> ["string", "min:8"]
        ];
    }
}
