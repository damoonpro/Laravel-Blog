<?php

namespace Damoon\Blog\Http\Requests\v1;

use Damoon\Tools\Helpers;
use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:9',
            'body' => 'required|string|min:18',
            'meta_title' => 'required|string|min:3',
            'meta_description' => 'required|string|min:9',
            'categories' => 'nullable|array',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge(Helpers::arrayPure([
            'title' => Helpers::stripTags(Helpers::toEnglish($this->input('title'))),
            'description' => Helpers::stripTags(Helpers::toEnglish($this->input('description'))),
            'body' => Helpers::stripTags(Helpers::toEnglish($this->input('body'))),
            'meta_title' => Helpers::stripTags(Helpers::toEnglish($this->input('meta_title'))),
            'meta_description' => Helpers::stripTags(Helpers::toEnglish($this->input('meta_description'))),
            'categories' => $this->input('categories'),
        ]));
    }
}
