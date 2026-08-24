<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->getTranslations('name'),
            'type' => $this->type,
            'phone' => $this->phone,
            'email' => $this->email,
            'national_id' => $this->national_id,
            'address' => $this->getTranslations('address'),
            'notes' => $this->getTranslations('notes'),
            'created_at' => $this->created_at,
        ];
    }
}
