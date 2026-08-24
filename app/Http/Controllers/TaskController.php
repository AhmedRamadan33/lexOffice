<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\CaseModel;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct(protected TaskService $tasks)
    {
    }

    public function index(Request $request): View
    {
        $filters = $request->only(['search', 'status', 'priority', 'assigned_to', 'per_page']);

        if ($request->boolean('mine')) {
            $filters['mine'] = $request->user()->id;
        }

        $tasks = $this->tasks->paginate($filters);

        return view('tasks.index', [
            'tasks' => $tasks,
            'users' => User::where('is_active', true)->orderBy('name->ar')->get(),
        ]);
    }

    public function create(): View
    {
        return view('tasks.create', $this->formData());
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $this->tasks->create($request->validated(), $request->user()->id);

        return redirect()->route('tasks.index')->with('success', __('app.messages.created'));
    }

    public function edit(Task $task): View
    {
        return view('tasks.edit', [...$this->formData(), 'task' => $task]);
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        $this->tasks->update($task, $request->validated());

        return redirect()->route('tasks.index')->with('success', __('app.messages.updated'));
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->tasks->delete($task);

        return redirect()->route('tasks.index')->with('success', __('app.messages.deleted'));
    }

    private function formData(): array
    {
        return [
            'cases' => CaseModel::orderBy('case_number')->get(),
            'users' => User::where('is_active', true)->orderBy('name->ar')->get(),
        ];
    }
}
