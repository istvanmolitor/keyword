<?php

namespace Molitor\Keyword\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KeywordText extends Model
{
    protected $fillable = [
        'text',
    ];

    public $timestamps = true;
}

