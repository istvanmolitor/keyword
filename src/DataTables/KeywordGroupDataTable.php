<?php

declare(strict_types=1);

namespace Molitor\Keyword\DataTables;

use Molitor\Admin\DataTables\DataTable;
use Molitor\Keyword\Http\Resources\KeywordGroupResource;
use Molitor\Keyword\Models\KeywordGroup;

class KeywordGroupDataTable extends DataTable
{
    protected function getModelClass(): string
    {
        return KeywordGroup::class;
    }

    protected function getResourceClass(): string
    {
        return KeywordGroupResource::class;
    }

    protected function getSearchPlaceholder(): string
    {
        return 'Keresés csoport neve alapján...';
    }

    protected function initColumns(): void
    {
        $this->addColumn('name')->setSearchable()->setOrderable();
    }
}
