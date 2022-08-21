<?php

namespace Damoon\Blog\Http\Requests\v1\File;

use Illuminate\Foundation\Http\FormRequest;

class Upload extends FormRequest
{
    public function authorize()
    {
        return auth()->user();
    }

    public function rules()
    {
        return [
            'file' => 'required|mimes:jpg,jpeg',
        ];
    }
}
