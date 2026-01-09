<?php

namespace Molitor\Keyword\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Keyword extends Model
{
    protected $fillable = [
        'name',
        'alias_keyword_id',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Keyword::class, 'alias_keyword_id');
    }

    public function aliases(): HasMany
    {
        return $this->hasMany(Keyword::class, 'alias_keyword_id');
    }
}
