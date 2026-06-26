<?php

namespace Molitor\Keyword\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Molitor\Admin\Traits\HasAdminFilters;
use Molitor\Keyword\Http\Requests\StoreKeywordRequest;
use Molitor\Keyword\Http\Requests\UpdateKeywordRequest;
use Molitor\Keyword\Http\Resources\KeywordResource;
use Molitor\Keyword\Http\Resources\KeywordSimpleResource;
use Molitor\Keyword\Models\Keyword;
use Molitor\Keyword\Models\KeywordGroup;

class KeywordApiController extends Controller
{
    use HasAdminFilters;

    public function index(Request $request): JsonResponse
    {
        $query = Keyword::query()
            ->with('aliasKeyword')
            ->select('keywords.*', DB::raw('(SELECT COUNT(*) FROM keywordables WHERE keywordables.keyword_id = keywords.id) as keywordables_count'));
        $keywords = $this->applyAdminFilters($query, $request, ['name'])
            ->paginate(10)
            ->withQueryString();

        return response()->json([
            'data' => KeywordResource::collection($keywords->items()),
            'meta' => [
                'current_page' => $keywords->currentPage(),
                'last_page' => $keywords->lastPage(),
                'per_page' => $keywords->perPage(),
                'total' => $keywords->total(),
            ],
            'filters' => $request->only(['search', 'sort', 'direction']),
        ]);
    }

    public function create(): JsonResponse
    {
        return response()->json([
            'alias_keywords' => KeywordSimpleResource::collection(
                Keyword::query()->orderBy('name')->get()
            ),
        ]);
    }

    public function show(Keyword $keyword): JsonResponse
    {
        $keyword->load('aliasKeyword');

        return response()->json([
            'data' => new KeywordResource($keyword),
        ]);
    }

    public function edit(Keyword $keyword): JsonResponse
    {
        $keyword->load(['aliasKeyword', 'groups']);

        return response()->json([
            'data' => new KeywordResource($keyword),
            'alias_keywords' => KeywordSimpleResource::collection(
                Keyword::query()
                    ->whereKeyNot($keyword->id)
                    ->orderBy('name')
                    ->get()
            ),
            'keyword_groups' => KeywordGroup::query()->orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function store(StoreKeywordRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $keyword = Keyword::create([
            'name' => $validated['name'],
            'is_stop_word' => (bool) ($validated['is_stop_word'] ?? false),
            'alias_keyword_id' => $validated['alias_keyword_id'] ?? null,
        ]);

        $keyword->load('aliasKeyword');

        return response()->json([
            'data' => new KeywordResource($keyword),
            'message' => __('keyword::keyword.messages.created'),
        ], 201);
    }

    public function update(UpdateKeywordRequest $request, Keyword $keyword): JsonResponse
    {
        $validated = $request->validated();

        $keyword->update([
            'name' => $validated['name'],
            'is_stop_word' => (bool) ($validated['is_stop_word'] ?? false),
            'alias_keyword_id' => $validated['alias_keyword_id'] ?? null,
        ]);

        $keyword->groups()->sync($validated['group_ids'] ?? []);

        $keyword->load(['aliasKeyword', 'groups']);

        return response()->json([
            'data' => new KeywordResource($keyword),
            'message' => __('keyword::keyword.messages.updated'),
        ]);
    }

    public function destroy(Keyword $keyword): JsonResponse
    {
        $keyword->delete();

        return response()->json([
            'message' => __('keyword::keyword.messages.deleted'),
        ]);
    }
}
