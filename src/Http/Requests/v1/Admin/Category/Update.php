<?php

namespace Damoon\Blog\Http\Requests\v1\Admin\Category;

use Damoon\Blog\Http\Middleware\Interfaces\IAdminUser;
use Damoon\Tools\Helpers;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->is_admin;
    }

    public function rules()
    {
        return [
            'label' => 'required|string|min:3',
            'confirmed' => 'nullable|bool',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge(Helpers::arrayPure([
            'label' => Helpers::stripTags(Helpers::toEnglish($this->input('label'))),
            'confirmed' => Helpers::stripTags(Helpers::toEnglish($this->input('confirmed'))),
        ]));
    }
}
