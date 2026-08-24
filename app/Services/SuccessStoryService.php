<?php

namespace App\Services;

use App\Models\SuccessStory;
use App\Repositories\Contracts\SuccessStoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SuccessStoryService
{
    public function __construct(protected SuccessStoryRepositoryInterface $stories)
    {
    }

    public function paginate(array $filters): LengthAwarePaginator
    {
        return $this->stories->paginate($filters);
    }

    public function listActive(): Collection
    {
        return $this->stories->listActive();
    }

    public function create(array $data, Request $request): SuccessStory
    {
        $story = $this->stories->create($data);

        if ($request->hasFile('image')) {
            $story->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return $story;
    }

    public function update(SuccessStory $story, array $data, Request $request): SuccessStory
    {
        $this->stories->update($story, $data);

        if ($request->hasFile('image')) {
            $story->addMediaFromRequest('image')->toMediaCollection('image');
        }

        return $story;
    }

    public function delete(SuccessStory $story): bool
    {
        return $this->stories->delete($story);
    }
}
