<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\Contracts\TaskRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskService
{
    public function __construct(protected TaskRepositoryInterface $tasks)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->tasks->paginate($filters);
    }

    public function create(array $data, int $userId): Task
    {
        $data['assigned_by'] = $userId;

        return $this->tasks->create($data);
    }

    public function update(Task $task, array $data): Task
    {
        return $this->tasks->update($task, $data);
    }

    public function delete(Task $task): bool
    {
        return $this->tasks->delete($task);
    }
}
