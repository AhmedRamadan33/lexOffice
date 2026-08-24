<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaseType\StoreCaseTypeRequest;
use App\Http\Requests\CaseType\UpdateCaseTypeRequest;
use App\Http\Resources\CaseTypeResource;
use App\Models\CaseType;
use App\Services\CaseTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CaseTypeController extends Controller
{
    public function __construct(protected CaseTypeService $caseTypes)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $caseTypes = $this->caseTypes->paginate($request->only(['search', 'is_active', 'per_page']));

        return response()->json(CaseTypeResource::collection($caseTypes)->response()->getData(true));
    }

    public function store(StoreCaseTypeRequest $request): JsonResponse
    {
        $caseType = $this->caseTypes->create($request->validated());

        return response()->json(new CaseTypeResource($caseType), 201);
    }

    public function show(CaseType $case_type): JsonResponse
    {
        return response()->json(new CaseTypeResource($case_type));
    }

    public function update(UpdateCaseTypeRequest $request, CaseType $case_type): JsonResponse
    {
        $this->caseTypes->update($case_type, $request->validated());

        return response()->json(new CaseTypeResource($case_type));
    }

    public function destroy(CaseType $case_type): JsonResponse
    {
        $this->caseTypes->delete($case_type);

        return response()->json(null, 204);
    }
}
