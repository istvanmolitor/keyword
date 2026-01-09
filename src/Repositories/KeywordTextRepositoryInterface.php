<?php

namespace Molitor\Keyword\Repositories;

use Illuminate\Support\LazyCollection;
use Molitor\Keyword\Models\KeywordText;

interface KeywordTextRepositoryInterface
{
    public function delete(KeywordText $keywordText): bool;

    public function update(KeywordText $keywordText, array $data): bool;

    public function create(array $data): KeywordText;

    public function getByText(string $text): ?KeywordText;

    public function getById(int $id): ?KeywordText;

    public function all(): LazyCollection;
}


