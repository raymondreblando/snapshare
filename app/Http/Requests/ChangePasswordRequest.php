<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->user->user_id !== $this->route('user')->user_id) {
            return false;
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'current_password:web'],
            'new_password' => ['required', 'min:8', 'max:255', 'confirmed'],
        ];
    }
}
