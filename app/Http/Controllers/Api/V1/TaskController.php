<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $tasks)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only(['search', 'status', 'priority', 'assigned_to', 'per_page']);

        if ($request->boolean('mine')) {
            $filters['mine'] = $request->user()->id;
        }

        $tasks = $this->tasks->paginate($filters);

        return response()->json(TaskResource::collection($tasks)->response()->getData(true));
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $this->tasks->create($request->validated(), $request->user()->id);
        $task->load(['case', 'assignee']);

        return response()->json(new TaskResource($task), 201);
    }

    public function show(Task $task): JsonResponse
    {
        $task->load(['case', 'assignee']);

        return response()->json(new TaskResource($task));
    }

    public function update(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $this->tasks->update($task, $request->validated());
        $task->load(['case', 'assignee']);

        return response()->json(new TaskResource($task));
    }

    public function destroy(Task $task): JsonResponse
    {
        $this->tasks->delete($task);

        return response()->json(null, 204);
    }
}
