<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaseSession\StoreSessionRequest;
use App\Http\Requests\CaseSession\UpdateSessionRequest;
use App\Http\Resources\CaseSessionResource;
use App\Models\CaseModel;
use App\Models\CaseSession;
use App\Services\CaseSessionService;
use Illuminate\Http\JsonResponse;

class CaseSessionController extends Controller
{
    public function __construct(protected CaseSessionService $sessions)
    {
    }

    public function index(CaseModel $case): JsonResponse
    {
        $sessions = $case->sessions()->with('court')->orderByDesc('session_date')->get();

        return response()->json(CaseSessionResource::collection($sessions));
    }

    public function store(StoreSessionRequest $request, CaseModel $case): JsonResponse
    {
        $session = $this->sessions->create($case, $request->validated(), $request->user()->id);

        return response()->json(new CaseSessionResource($session), 201);
    }

    public function update(UpdateSessionRequest $request, CaseModel $case, CaseSession $session): JsonResponse
    {
        $this->sessions->update($session, $request->validated());

        return response()->json(new CaseSessionResource($session));
    }

    public function destroy(CaseModel $case, CaseSession $session): JsonResponse
    {
        $this->sessions->delete($session);

        return response()->json(null, 204);
    }
}
