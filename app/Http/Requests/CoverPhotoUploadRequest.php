<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CoverPhotoUploadRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cover_photo' => ['image', 'mimes:png,jpg,webp', 'max:5120']
        ];
    }
}
