<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\StoreBranchRequest;
use App\Http\Requests\Branch\UpdateBranchRequest;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use App\Services\BranchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function __construct(protected BranchService $branches)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $branches = $this->branches->paginate($request->only(['search', 'is_active', 'per_page']));

        return response()->json(BranchResource::collection($branches)->response()->getData(true));
    }

    public function store(StoreBranchRequest $request): JsonResponse
    {
        $branch = $this->branches->create($request->validated());

        return response()->json(new BranchResource($branch), 201);
    }

    public function show(Branch $branch): JsonResponse
    {
        return response()->json(new BranchResource($branch));
    }

    public function update(UpdateBranchRequest $request, Branch $branch): JsonResponse
    {
        $this->branches->update($branch, $request->validated());

        return response()->json(new BranchResource($branch));
    }

    public function destroy(Branch $branch): JsonResponse
    {
        try {
            $this->branches->delete($branch);
        } catch (\DomainException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json(null, 204);
    }
}
