<?php

namespace Molitor\Keyword\Repositories;

use Illuminate\Support\LazyCollection;
use Molitor\Keyword\Models\KeywordText;

class KeywordTextRepository implements KeywordTextRepositoryInterface
{
    private KeywordText $keywordText;

    public function __construct()
    {
        $this->keywordText = new KeywordText();
    }

    public function all(): LazyCollection
    {
        return $this->keywordText->cursor();
    }

    public function getById(int $id): ?KeywordText
    {
        return $this->keywordText->find($id);
    }

    public function getByText(string $text): ?KeywordText
    {
        return $this->keywordText->where('text', $text)->first();
    }

    public function create(array $data): KeywordText
    {
        return $this->keywordText->create($data);
    }

    public function update(KeywordText $keywordText, array $data): bool
    {
        return $keywordText->update($data);
    }

    public function delete(KeywordText $keywordText): bool
    {
        return $keywordText->delete();
    }
}

