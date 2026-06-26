<?php

declare(strict_types=1);

namespace Molitor\Keyword\Traits;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Molitor\Keyword\Models\Keyword;

trait HasKeywords
{
    public function keywords(): MorphToMany
    {
        return $this->morphToMany(Keyword::class, 'keywordable');
    }
}
