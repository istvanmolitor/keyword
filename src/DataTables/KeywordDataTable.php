<?php

declare(strict_types=1);

namespace Molitor\Keyword\DataTables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Molitor\Admin\DataTables\DataTable;
use Molitor\Keyword\Http\Resources\KeywordResource;
use Molitor\Keyword\Models\Keyword;

class KeywordDataTable extends DataTable
{
    protected function getModelClass(): string
    {
        return Keyword::class;
    }

    protected function getResourceClass(): string
    {
        return KeywordResource::class;
    }

    protected function getSearchPlaceholder(): string
    {
        return 'Keresés kulcsszó alapján...';
    }

    protected function initColumns(): void
    {
        $this->addColumn('name')->setSearchable()->setOrderable();
        $this->addColumn('alias_keyword')->setLabel('Alias kulcsszó');
        $this->addColumn('is_stop_word')->setLabel('Tiltószó');
    }

    public function query(Builder $query): Builder
    {
        return $query
            ->with('aliasKeyword')
            ->select('keywords.*', DB::raw('(SELECT COUNT(*) FROM keywordables WHERE keywordables.keyword_id = keywords.id) as keywordables_count'));
    }
}
