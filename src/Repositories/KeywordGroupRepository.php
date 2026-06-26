<?php

namespace Molitor\Keyword\Repositories;

use Molitor\Keyword\Models\KeywordGroup;

class KeywordGroupRepository implements KeywordGroupRepositoryInterface
{
    public function getById(int $id): ?KeywordGroup
    {
        return KeywordGroup::find($id);
    }

    public function create(array $data): KeywordGroup
    {
        return KeywordGroup::create($data);
    }

    public function update(KeywordGroup $group, array $data): bool
    {
        return $group->update($data);
    }

    public function delete(KeywordGroup $group): bool
    {
        return $group->delete();
    }
}
