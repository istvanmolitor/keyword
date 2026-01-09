<?php

namespace Molitor\Keyword\Repositories;

use Illuminate\Support\Collection;
use Molitor\Keyword\Models\Keyword;

interface KeywordRepositoryInterface
{
    /** @return Collection<int,Keyword> */
    public function all(): Collection;

    public function getById(int $id): ?Keyword;

    public function getByName(string $name): ?Keyword;

    public function create(array $data): Keyword;

    public function update(Keyword $keyword, array $data): bool;

    public function delete(Keyword $keyword): bool;
}
