<?php

namespace App\Http\Requests\Court;

class UpdateCourtRequest extends StoreCourtRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge(['is_active' => $this->boolean('is_active')]);
    }
}
