<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaseModel\StoreCaseRequest;
use App\Http\Requests\CaseModel\UpdateCaseRequest;
use App\Http\Resources\CaseResource;
use App\Models\CaseModel;
use App\Services\CaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CaseController extends Controller
{
    public function __construct(protected CaseService $cases)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $cases = $this->cases->paginate($request->only(['search', 'status', 'court_id', 'case_type_id', 'assigned_lawyer_id', 'per_page']));

        return response()->json(CaseResource::collection($cases)->response()->getData(true));
    }

    public function store(StoreCaseRequest $request): JsonResponse
    {
        $case = $this->cases->create($request->validated(), $request->user()->id);
        $case->load(['client', 'court', 'caseType', 'assignedLawyer']);

        return response()->json(new CaseResource($case), 201);
    }

    public function show(CaseModel $case): JsonResponse
    {
        $case->load(['client', 'court', 'caseType', 'assignedLawyer']);

        return response()->json(new CaseResource($case));
    }

    public function update(UpdateCaseRequest $request, CaseModel $case): JsonResponse
    {
        $this->cases->update($case, $request->validated());
        $case->load(['client', 'court', 'caseType', 'assignedLawyer']);

        return response()->json(new CaseResource($case));
    }

    public function destroy(CaseModel $case): JsonResponse
    {
        $this->cases->delete($case);

        return response()->json(null, 204);
    }
}
