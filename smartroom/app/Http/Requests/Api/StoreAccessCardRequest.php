<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccessCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'classroom_id' => ['nullable', 'integer', 'exists:classrooms,id'],
            'card_number' => ['required', 'string', 'max:255', 'unique:access_cards,card_number'],
            'rfid_uid' => ['required', 'string', 'max:255', 'unique:access_cards,rfid_uid'],
            'status' => ['nullable', 'string', 'max:50'],
            'expires_at' => ['nullable', 'date'],
            'last_accessed_at' => ['nullable', 'date'],
            'access_count' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
