<?php

namespace App\Http\Requests\Court;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourtRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge(['is_active' => $this->boolean('is_active', true)]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'name.ar' => ['required', 'string', 'max:255'],
            'name.en' => ['nullable', 'string', 'max:255'],
            'type' => ['nullable', 'array'],
            'type.ar' => ['nullable', 'string', 'max:255'],
            'type.en' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'array'],
            'address.ar' => ['nullable', 'string'],
            'address.en' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ];
    }
}
