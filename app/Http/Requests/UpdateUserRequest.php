<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->user()->user_id !== $this->route('user')->user_id) {
            return false;
        }

        return true;
    }

    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore(Auth::user()->user_id, 'user_id')],
            'email' => ['required', 'string', 'max:255', 'email', Rule::unique('users', 'email')->ignore(Auth::user()->user_id, 'user_id')],
            'phone_number' => ['nullable', 'min:11', 'max:11', Rule::unique('users', 'phone_number')->ignore(Auth::user()->user_id, 'user_id')],
            'address' => ['nullable', 'max:255'],
        ];
    }
}
