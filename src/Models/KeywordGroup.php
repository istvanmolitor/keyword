<?php

namespace Molitor\Keyword\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class KeywordGroup extends Model
{
    protected static function booted(): void
    {
        static::creating(function (KeywordGroup $group) {
            if (empty($group->slug)) {
                $group->slug = Str::slug($group->name);
            }
        });
    }

    protected $fillable = [
        'name',
        'slug',
    ];

    public function keywords(): BelongsToMany
    {
        return $this->belongsToMany(Keyword::class);
    }
}
