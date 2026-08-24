<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\StoreDocumentRequest;
use App\Http\Resources\DocumentResource;
use App\Services\DocumentService;
use Illuminate\Http\JsonResponse;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DocumentController extends Controller
{
    public function __construct(protected DocumentService $documents)
    {
    }

    public function store(StoreDocumentRequest $request, string $type, int $id): JsonResponse
    {
        $media = $this->documents->upload($type, $id, $request);

        return response()->json(new DocumentResource($media), 201);
    }

    public function destroy(Media $media): JsonResponse
    {
        $this->documents->delete($media);

        return response()->json(null, 204);
    }
}
