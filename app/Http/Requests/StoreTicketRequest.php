<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "user_id"=> ["required", "exists:user,id"],
            "cinema_id"=> ["required", "exists:cinema,id"],
            "time"=> ["required"],
            "salon"=> ["required", "integer"],
        ];
    }
}
