<?php

namespace Molitor\Keyword\Services;

use Molitor\Keyword\Models\Keyword;
use Molitor\Keyword\Repositories\KeywordRepositoryInterface;

class KeywordService
{
    public function __construct(
        private readonly KeywordRepositoryInterface $keywordRepository,
    ) {}

    /**
     * @param string[] $keywords
     * @return int[]
     */
    public function saveKeywords(array $keywords): array
    {
        return array_map(
            fn($name) => $this->keywordRepository->getByName($name)->id,
            $keywords
        );
    }

    public function explode(string $text): array
    {
        return array_values(array_unique(
            array_filter(
                array_map(fn($k) => mb_strtolower(trim($k)), explode(',', $text))
            )
        ));
    }

    public function getIds(string $text): array
    {
        return $this->saveKeywords($this->explode($text));   
    }
}
