<?php

namespace App\Http\Requests\Branch;

class UpdateBranchRequest extends StoreBranchRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_main' => $this->boolean('is_main'),
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
