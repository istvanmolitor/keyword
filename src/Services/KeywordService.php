<?php

namespace Molitor\Keyword\Services;

use Molitor\Keyword\Repositories\KeywordRepositoryInterface;

class KeywordService
{
    private array $keywords = [];

    public function loadKeywords(): void
    {
        $this->keywords = [];
        foreach ($this->keywordRepository->all() as $keyword) {
            $this->keywords[$keyword->name] = $keyword->alias_keyword_id ?? $keyword->id;
        }
    }

    public function __construct(
        private KeywordRepositoryInterface $keywordRepository
    ) {
    }

    public function splitIntoSentences(string $text): array
    {
        return array_map(function ($word) {
            return trim($word);
        }, explode('.', $text));
    }

    public function splitIntoWords(string $sentence): array
    {
        return array_map(function ($word) {
            return trim($word);
        }, explode(' ', $sentence));
    }

    public function getUniqueWords(string $text): array
    {
        $words = [];
        foreach ($this->splitIntoSentences($text) as $sentence) {
            $words = array_merge($words, $this->splitIntoWords($sentence));
        }
        return array_unique($words);
    }

    /**
     * Kulcsszavakra bontja a szöveget és elmenti az adatbázisba.
     *
     * @param string $text A feldolgozandó szöveg
     * @return array A létrehozott/megtalált kulcsszavak ID-i növekvő sorrendben
     */
    public function createKeywords(string $text): array
    {
        $uniqueWords = $this->getUniqueWords($text);

        if (empty($uniqueWords)) {
            return [];
        }

        $this->keywordRepository->create($uniqueWords);

        // ID-k gyűjtése és növekvő sorrendbe rendezése
        $keywordIds = $keywords->pluck('id')->toArray();
        sort($keywordIds);

        return $keywordIds;
    }




}
