<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'case_number' => $this->case_number,
            'client' => new ClientResource($this->whenLoaded('client')),
            'court' => $this->whenLoaded('court', fn () => $this->court?->getTranslations('name')),
            'case_type' => $this->whenLoaded('caseType', fn () => $this->caseType?->getTranslations('name')),
            'assigned_lawyer' => $this->whenLoaded('assignedLawyer', fn () => $this->assignedLawyer?->getTranslations('name')),
            'opponent_name' => $this->getTranslations('opponent_name'),
            'opponent_phone' => $this->opponent_phone,
            'subject' => $this->getTranslations('subject'),
            'status' => $this->status,
            'start_date' => $this->start_date,
            'notes' => $this->getTranslations('notes'),
            'created_at' => $this->created_at,
        ];
    }
}
