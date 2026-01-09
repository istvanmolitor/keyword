<?php

namespace Molitor\Keyword\Filament\Resources;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Molitor\Keyword\Filament\Resources\KeywordTextResource\Pages;
use Molitor\Keyword\Models\KeywordText;

class KeywordTextResource extends Resource
{
    protected static ?string $model = KeywordText::class;

    protected static \BackedEnum|null|string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): string
    {
        return 'Tartalom';
    }

    public static function getNavigationLabel(): string
    {
        return 'Kulcsszó szövegek';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\Textarea::make('text')
                    ->label('Szöveg')
                    ->required()
                    ->maxLength(65535)
                    ->rows(5)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('tokens')
                    ->label('Tokenek (automatikusan generált)')
                    ->disabled()
                    ->rows(3)
                    ->columnSpanFull()
                    ->dehydrated(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('text')
                    ->label('Szöveg')
                    ->searchable()
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\TextColumn::make('tokens')
                    ->label('Tokenek')
                    ->searchable()
                    ->limit(30)
                    ->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Létrehozva')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Módosítva')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKeywordTexts::route('/'),
            'create' => Pages\CreateKeywordText::route('/create'),
            'edit' => Pages\EditKeywordText::route('/{record}/edit'),
        ];
    }
}

