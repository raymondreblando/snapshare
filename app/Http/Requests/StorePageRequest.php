<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page_cover' => ['required', 'image', 'mimes:png,jpg,webp', 'max:5120'],
            'page_profile' => ['required', 'image', 'mimes:png,jpg,webp', 'max:5120'],
            'page_name' => ['required', 'max:255'],
        ];
    }
}
