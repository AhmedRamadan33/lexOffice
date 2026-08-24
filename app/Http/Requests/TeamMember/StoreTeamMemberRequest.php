<?php

namespace App\Http\Requests\TeamMember;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'sort_order' => $this->input('sort_order', 0),
            'is_featured' => $this->boolean('is_featured'),
            'is_active' => $this->boolean('is_active', true),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'name.ar' => ['required', 'string', 'max:255'],
            'name.en' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'array'],
            'title.ar' => ['nullable', 'string', 'max:255'],
            'title.en' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'array'],
            'bio.ar' => ['nullable', 'string'],
            'bio.en' => ['nullable', 'string'],
            'specialties' => ['nullable', 'array'],
            'specialties.ar' => ['nullable', 'string'],
            'specialties.en' => ['nullable', 'string'],
            'education' => ['nullable', 'array'],
            'education.ar' => ['nullable', 'string'],
            'education.en' => ['nullable', 'string'],
            'experience' => ['nullable', 'array'],
            'experience.ar' => ['nullable', 'string'],
            'experience.en' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'photo' => ['nullable', 'image', 'max:4096'],
            'is_featured' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
            'is_active' => ['boolean'],
        ];
    }
}
