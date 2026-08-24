<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActivityLogResource;
use App\Services\ActivityLogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function __construct(protected ActivityLogService $logs)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $logs = $this->logs->paginate($request->only(['search', 'event', 'subject_type', 'branch_id', 'per_page']));

        return response()->json(ActivityLogResource::collection($logs)->response()->getData(true));
    }
}
