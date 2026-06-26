<?php

namespace Molitor\Keyword\Http\Requests\KeywordGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKeywordGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $groupId = $this->route('keyword_group')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('keyword_groups', 'name')->ignore($groupId),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('keyword_groups', 'slug')->ignore($groupId),
            ],
            'is_public' => 'boolean',
        ];
    }
}
