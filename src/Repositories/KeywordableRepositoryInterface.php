<?php

declare(strict_types=1);

namespace Molitor\Keyword\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface KeywordableRepositoryInterface
{
    public function getByModel(Model $model): Collection;

    public function attach(Model $model, int $keywordId): void;

    public function detach(Model $model, int $keywordId): void;

    public function sync(Model $model, array $keywordIds): void;

    public function updateByString(Model $model, string $keywordsString): void;
}
