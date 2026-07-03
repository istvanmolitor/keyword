<?php

namespace Molitor\Keyword\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\LazyCollection;
use Molitor\Keyword\Models\Keyword;

interface KeywordRepositoryInterface
{
    public function all(): LazyCollection;

    public function getMostUsed(int $limit): Collection;

    public function getById(int $id): ?Keyword;

    public function getByName(string $name): ?Keyword;

    public function getBySlug(string $slug): ?Keyword;

    public function create(array $keywords): void;

    public function update(Keyword $keyword, array $data): bool;

    public function delete(Keyword $keyword): bool;

    public function deleteAll(): int;
}
