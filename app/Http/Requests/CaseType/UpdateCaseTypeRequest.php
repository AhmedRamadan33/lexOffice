<?php

namespace App\Http\Requests\CaseType;

class UpdateCaseTypeRequest extends StoreCaseTypeRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge(['is_active' => $this->boolean('is_active')]);
    }
}
