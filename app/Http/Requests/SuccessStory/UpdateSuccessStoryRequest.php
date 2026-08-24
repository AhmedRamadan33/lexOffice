<?php

namespace App\Http\Requests\SuccessStory;

class UpdateSuccessStoryRequest extends StoreSuccessStoryRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'sort_order' => $this->input('sort_order', 0),
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
