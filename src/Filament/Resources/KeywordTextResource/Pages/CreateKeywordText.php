<?php

namespace Molitor\Keyword\Filament\Resources\KeywordTextResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Molitor\Keyword\Filament\Resources\KeywordTextResource;

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
}

