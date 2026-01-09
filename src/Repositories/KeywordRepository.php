<?php

namespace Molitor\Keyword\Repositories;

use Illuminate\Support\Collection;
use Molitor\Keyword\Models\Keyword;

class KeywordRepository implements KeywordRepositoryInterface
{
    public function all(): Collection
    {
        return Keyword::all();
    }

    public function getById(int $id): ?Keyword
    {
        return Keyword::find($id);
    }

    public function getByName(string $name): ?Keyword
    {
        return Keyword::where('name', $name)->first();
    }

    public function create(array $data): Keyword
    {
        return Keyword::create($data);
    }

    public function update(Keyword $keyword, array $data): bool
    {
        return $keyword->update($data);
    }

    public function delete(Keyword $keyword): bool
    {
        return $keyword->delete();
    }
}
