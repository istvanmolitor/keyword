<?php

namespace Molitor\Keyword\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Molitor\Admin\Traits\HasAdminFilters;
use Molitor\Keyword\Http\Requests\KeywordGroup\StoreKeywordGroupRequest;
use Molitor\Keyword\Http\Requests\KeywordGroup\UpdateKeywordGroupRequest;
use Molitor\Keyword\Http\Resources\KeywordGroupResource;
use Molitor\Keyword\Models\Keyword;
use Molitor\Keyword\Models\KeywordGroup;

class KeywordGroupApiController extends Controller
{
    use HasAdminFilters;

    public function index(Request $request): JsonResponse
    {
        $query = KeywordGroup::query();
        $groups = $this->applyAdminFilters($query, $request, ['name'])
            ->paginate(10)
            ->withQueryString();

        return response()->json([
            'data' => KeywordGroupResource::collection($groups->items()),
            'meta' => [
                'current_page' => $groups->currentPage(),
                'last_page' => $groups->lastPage(),
                'per_page' => $groups->perPage(),
                'total' => $groups->total(),
            ],
            'filters' => $request->only(['search', 'sort', 'direction']),
        ]);
    }

    public function show(KeywordGroup $keywordGroup): JsonResponse
    {
        $keywordGroup->load('keywords');

        return response()->json([
            'data' => new KeywordGroupResource($keywordGroup),
        ]);
    }

    public function attachKeyword(Request $request, KeywordGroup $keywordGroup): JsonResponse
    {
        $request->validate(['keyword_id' => 'required|exists:keywords,id']);
        $keywordGroup->keywords()->syncWithoutDetaching([$request->keyword_id]);

        return response()->json(['message' => 'Kulcsszó hozzáadva.']);
    }

    public function detachKeyword(KeywordGroup $keywordGroup, Keyword $keyword): JsonResponse
    {
        $keywordGroup->keywords()->detach($keyword->id);

        return response()->json(['message' => 'Kulcsszó eltávolítva.']);
    }

    public function store(StoreKeywordGroupRequest $request): JsonResponse
    {
        $group = KeywordGroup::create($request->validated());

        return response()->json([
            'data' => new KeywordGroupResource($group),
            'message' => __('keyword::keyword.groups.messages.created'),
        ], 201);
    }

    public function update(UpdateKeywordGroupRequest $request, KeywordGroup $keywordGroup): JsonResponse
    {
        $keywordGroup->update($request->validated());

        return response()->json([
            'data' => new KeywordGroupResource($keywordGroup),
            'message' => __('keyword::keyword.groups.messages.updated'),
        ]);
    }

    public function destroy(KeywordGroup $keywordGroup): JsonResponse
    {
        $keywordGroup->delete();

        return response()->json([
            'message' => __('keyword::keyword.groups.messages.deleted'),
        ]);
    }
}
