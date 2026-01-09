<?php

namespace Molitor\Keyword\Filament\Resources\KeywordTextResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Molitor\Keyword\Filament\Resources\KeywordTextResource;

class ListKeywordTexts extends ListRecords
{
    protected static string $resource = KeywordTextResource::class;

    public function getBreadcrumb(): string
    {
        return 'Lista';
    }

    public function getTitle(): string
    {
        return 'Kulcsszó szövegek';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Új kulcsszó szöveg')
                ->icon('heroicon-o-plus'),
        ];
    }
}
