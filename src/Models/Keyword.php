<?php

namespace Molitor\Keyword\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Keyword extends Model
{
    public $timestamps = false;

    protected static function booted(): void
    {
        static::creating(function (Keyword $keyword) {
            if (empty($keyword->slug)) {
                $keyword->slug = Str::slug($keyword->name);
            }
        });
    }

    protected $fillable = [
        'name',
        'slug',
        'is_stop_word',
        'alias_keyword_id',
    ];

    protected $casts = [
        'is_stop_word' => 'boolean',
    ];

    public function aliasKeyword(): BelongsTo
    {
        return $this->belongsTo(Keyword::class, 'alias_keyword_id');
    }

    public function replacedKeywords(): HasMany
    {
        return $this->hasMany(Keyword::class, 'alias_keyword_id');
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(KeywordGroup::class);
    }
}
