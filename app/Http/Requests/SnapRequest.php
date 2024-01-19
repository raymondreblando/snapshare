<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SnapRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'snap' => ['required', 'image', 'mimes:png,jpg,webp', 'max:5120'],
            'snap_caption' => ['max:1000'],
            'snap_privacy' => ['required', 'max:30']
        ];
    }
}
