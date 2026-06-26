<?php

namespace Molitor\Keyword\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KeywordResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'is_stop_word' => (bool) $this->is_stop_word,
            'alias_keyword_id' => $this->alias_keyword_id,
            'alias_keyword' => $this->whenLoaded('aliasKeyword', fn () => $this->aliasKeyword ? [
                'id' => $this->aliasKeyword->id,
                'name' => $this->aliasKeyword->name,
            ] : null),
            'keywordables_count' => (int) ($this->keywordables_count ?? 0),
            'group_ids' => $this->whenLoaded('groups', fn () => $this->groups->pluck('id')->toArray()),
        ];
    }
}
