<?php

namespace Molitor\Keyword\Repositories;

use Illuminate\Support\Collection;
use Molitor\Keyword\Models\KeywordGroup;

interface KeywordGroupRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?KeywordGroup;

    public function create(array $data): KeywordGroup;

    public function update(KeywordGroup $group, array $data): bool;

    public function delete(KeywordGroup $group): bool;
}
