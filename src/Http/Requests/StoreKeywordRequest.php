<?php

namespace Molitor\Keyword\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeywordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:keywords,name',
            'slug' => 'required|string|max:255|unique:keywords,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'is_stop_word' => 'nullable|boolean',
            'alias_keyword_id' => 'nullable|integer|exists:keywords,id',
        ];
    }
}
