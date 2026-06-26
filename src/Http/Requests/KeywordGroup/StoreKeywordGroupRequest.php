<?php

namespace Molitor\Keyword\Http\Requests\KeywordGroup;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeywordGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:keyword_groups,name',
            'slug' => 'required|string|max:255|unique:keyword_groups,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'is_public' => 'boolean',
        ];
    }
}
