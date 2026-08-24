<?php

namespace App\Http\Requests\SuccessStory;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuccessStoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'sort_order' => $this->input('sort_order', 0),
            'is_active' => $this->boolean('is_active', true),
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'array'],
            'title.ar' => ['required', 'string', 'max:255'],
            'title.en' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'array'],
            'excerpt.ar' => ['nullable', 'string'],
            'excerpt.en' => ['nullable', 'string'],
            'body' => ['nullable', 'array'],
            'body.ar' => ['nullable', 'string'],
            'body.en' => ['nullable', 'string'],
            'category' => ['nullable', 'array'],
            'category.ar' => ['nullable', 'string', 'max:100'],
            'category.en' => ['nullable', 'string', 'max:100'],
            'story_date' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:4096'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }
}
