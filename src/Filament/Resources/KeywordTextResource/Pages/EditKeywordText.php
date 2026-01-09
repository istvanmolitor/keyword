<?php

namespace Molitor\Keyword\Filament\Resources\KeywordTextResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Molitor\Keyword\Filament\Resources\KeywordTextResource;
use Molitor\Keyword\Services\KeywordService;

class EditKeywordText extends EditRecord
{
    protected static string $resource = KeywordTextResource::class;

    public function getBreadcrumb(): string
    {
        return 'Szerkesztés';
    }

    public function getTitle(): string
    {
        return 'Kulcsszó szöveg szerkesztése';
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->label('Törlés'),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $keywordService = app(KeywordService::class);
        $data['tokens'] = $keywordService->getTokensString($data['text']);
        return $data;
    }
}

