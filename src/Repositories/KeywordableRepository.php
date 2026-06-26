<?php

declare(strict_types=1);

namespace Molitor\Keyword\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Molitor\Keyword\Services\KeywordService;
use Molitor\Keyword\Traits\HasKeywords;

class KeywordableRepository implements KeywordableRepositoryInterface
{
    public function __construct(private readonly KeywordService $keywordService) {}

    public function getByModel(Model $model): Collection
    {
        $this->assertHasKeywords($model);

        return $model->keywords;
    }

    public function attach(Model $model, int $keywordId): void
    {
        $this->assertHasKeywords($model);

        $model->keywords()->attach($keywordId);
    }

    public function detach(Model $model, int $keywordId): void
    {
        $this->assertHasKeywords($model);

        $model->keywords()->detach($keywordId);
    }

    public function sync(Model $model, array $keywordIds): void
    {
        $this->assertHasKeywords($model);

        $model->keywords()->sync($keywordIds);
    }

    public function updateByString(Model $model, string $keywordsString): void
    {
        $this->assertHasKeywords($model);

        $ids = $this->keywordService->getIds($keywordsString);
        $model->keywords()->sync($ids);
    }

    private function assertHasKeywords(Model $model): void
    {
        if (!in_array(HasKeywords::class, class_uses_recursive($model))) {
            throw new \InvalidArgumentException(
                get_class($model) . ' must use the HasKeywords trait.'
            );
        }
    }
}
