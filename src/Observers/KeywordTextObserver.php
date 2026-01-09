<?php

namespace Molitor\Keyword\Observers;

use Molitor\Keyword\Models\KeywordText;
use Molitor\Keyword\Services\KeywordService;

class KeywordTextObserver
{
    public function __construct(
        private KeywordService $keywordService
    ) {
    }

    /**
     * Handle the KeywordText "creating" event.
     */
    public function creating(KeywordText $keywordText): void
    {
        $keywordText->tokens = $this->keywordService->getTokensString($keywordText->text);
    }

    /**
     * Handle the KeywordText "updating" event.
     */
    public function updating(KeywordText $keywordText): void
    {
        $keywordText->tokens = $this->keywordService->getTokensString($keywordText->text);
    }
}

