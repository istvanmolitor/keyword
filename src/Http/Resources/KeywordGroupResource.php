<?php

namespace Molitor\Keyword\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KeywordGroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'is_public' => $this->is_public,
            'keywords' => $this->whenLoaded('keywords', fn () => $this->keywords->map(fn ($k) => [
                'id' => $k->id,
                'name' => $k->name,
            ])->values()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
