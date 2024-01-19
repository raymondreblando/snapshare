<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSnapRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'snap' => ['sometimes', 'nullable', 'image', 'mimes:png,jpg,webp'],
            'snap_caption' => ['max:1000'],
            'snap_privacy' => ['required', 'max:30']
        ];
    }
}
