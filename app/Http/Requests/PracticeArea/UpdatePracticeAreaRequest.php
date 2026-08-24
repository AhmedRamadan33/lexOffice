<?php

namespace App\Http\Requests\PracticeArea;

class UpdatePracticeAreaRequest extends StorePracticeAreaRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'sort_order' => $this->input('sort_order', 0),
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
