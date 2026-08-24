<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityLogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'event' => $this->event,
            'subject_type' => $this->subject_type,
            'subject_label' => $this->subject_label,
            'subject_id' => $this->subject_id,
            'description' => $this->description,
            'causer' => $this->causer ? [
                'id' => $this->causer->id,
                'name' => $this->causer->getTranslations('name'),
                'branch' => $this->causer->branch ? [
                    'id' => $this->causer->branch->id,
                    'name' => $this->causer->branch->getTranslations('name'),
                ] : null,
            ] : null,
            'changes' => $this->formatted_changes,
            'created_at' => $this->created_at,
        ];
    }
}
