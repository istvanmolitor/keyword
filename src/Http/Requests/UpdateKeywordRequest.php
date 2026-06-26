<?php

namespace Molitor\Keyword\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKeywordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $keywordId = $this->route('keyword')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('keywords', 'name')->ignore($keywordId),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('keywords', 'slug')->ignore($keywordId),
            ],
            'is_stop_word' => 'nullable|boolean',
            'alias_keyword_id' => [
                'nullable',
                'integer',
                'exists:keywords,id',
                Rule::notIn([$keywordId]),
            ],
        ];
    }
}
