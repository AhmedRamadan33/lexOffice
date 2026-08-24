<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'invoice_id' => $this->invoice_id,
            'amount' => $this->amount,
            'paid_at' => $this->paid_at,
            'method' => $this->method,
            'notes' => $this->getTranslations('notes'),
            'created_by' => $this->whenLoaded('creator', fn () => $this->creator?->getTranslations('name')),
            'created_at' => $this->created_at,
        ];
    }
}
