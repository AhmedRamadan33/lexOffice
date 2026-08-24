<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BranchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->getTranslations('name'),
            'phone' => $this->phone,
            'address' => $this->getTranslations('address'),
            'is_main' => $this->is_main,
            'is_active' => $this->is_active,
        ];
    }
}
