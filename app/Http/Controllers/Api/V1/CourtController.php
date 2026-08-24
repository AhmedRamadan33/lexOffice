<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Court\StoreCourtRequest;
use App\Http\Requests\Court\UpdateCourtRequest;
use App\Http\Resources\CourtResource;
use App\Models\Court;
use App\Services\CourtService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CourtController extends Controller
{
    public function __construct(protected CourtService $courts)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $courts = $this->courts->paginate($request->only(['search', 'is_active', 'per_page']));

        return response()->json(CourtResource::collection($courts)->response()->getData(true));
    }

    public function store(StoreCourtRequest $request): JsonResponse
    {
        $court = $this->courts->create($request->validated());

        return response()->json(new CourtResource($court), 201);
    }

    public function show(Court $court): JsonResponse
    {
        return response()->json(new CourtResource($court));
    }

    public function update(UpdateCourtRequest $request, Court $court): JsonResponse
    {
        $this->courts->update($court, $request->validated());

        return response()->json(new CourtResource($court));
    }

    public function destroy(Court $court): JsonResponse
    {
        $this->courts->delete($court);

        return response()->json(null, 204);
    }
}
