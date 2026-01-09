<?php

namespace Molitor\Keyword\Filament\Resources\KeywordTextResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Molitor\Keyword\Filament\Resources\KeywordTextResource;
use Molitor\Keyword\Services\KeywordService;

class CreateKeywordText extends CreateRecord
{
    protected static string $resource = KeywordTextResource::class;

    public function getBreadcrumb(): string
    {
        return 'Létrehozás';
    }

    public function getTitle(): string
    {
        return 'Új kulcsszó szöveg';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $keywordService = app(KeywordService::class);
        $data['tokens'] = $keywordService->getTokensString($data['text']);
        return $data;
    }
}

