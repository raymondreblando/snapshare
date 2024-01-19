<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page_cover' => ['sometimes', 'nullable', 'image', 'mimes:png,jpg,webp', 'max:5120'],
            'page_profile' => ['sometimes', 'nullable','image', 'mimes:png,jpg,webp', 'max:5120'],
            'page_name' => ['required', 'max:255'],
        ];
    }
}
