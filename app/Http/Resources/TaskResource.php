<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'case_id' => $this->case_id,
            'assigned_to' => $this->whenLoaded('assignee', fn () => $this->assignee?->getTranslations('name')),
            'title' => $this->getTranslations('title'),
            'description' => $this->getTranslations('description'),
            'due_date' => $this->due_date,
            'status' => $this->status,
            'priority' => $this->priority,
        ];
    }
}
