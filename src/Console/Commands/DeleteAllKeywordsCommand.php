<?php

namespace Molitor\Keyword\Console\Commands;

use Illuminate\Console\Command;
use Molitor\Keyword\Repositories\KeywordRepositoryInterface;

class DeleteAllKeywordsCommand extends Command
{
    protected $signature = 'keyword:delete-all-keywords';

    protected $description = 'Delete all keyword records';

    public function handle(KeywordRepositoryInterface $keywordRepository): int
    {
        $deletedCount = $keywordRepository->deleteAll();

        $this->info("Deleted {$deletedCount} keywords.");

        return self::SUCCESS;
    }
}
