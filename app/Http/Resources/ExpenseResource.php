<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'branch_id' => $this->branch_id,
            'category' => $this->getTranslations('category'),
            'amount' => $this->amount,
            'expense_date' => $this->expense_date,
            'description' => $this->getTranslations('description'),
            'created_at' => $this->created_at,
        ];
    }
}
