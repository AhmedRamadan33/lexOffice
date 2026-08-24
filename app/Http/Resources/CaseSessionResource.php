<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaseSessionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'case_id' => $this->case_id,
            'court' => $this->whenLoaded('court', fn () => $this->court?->getTranslations('name')),
            'session_date' => $this->session_date,
            'session_time' => $this->session_time,
            'judge_name' => $this->getTranslations('judge_name'),
            'notes' => $this->getTranslations('notes'),
            'decision' => $this->getTranslations('decision'),
            'next_session_date' => $this->next_session_date,
            'status' => $this->status,
        ];
    }
}
