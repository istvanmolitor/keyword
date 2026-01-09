<?php

namespace Molitor\Keyword\Filament\Resources\KeywordResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Molitor\Keyword\Filament\Resources\KeywordResource;

class CreateKeyword extends CreateRecord
{
    protected static string $resource = KeywordResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Kulcsszó létrehozása';
    }
}

