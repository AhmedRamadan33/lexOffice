<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'is_team_visible' => $this->boolean('is_team_visible'),
            'sort_order' => $this->input('sort_order', 0),
        ]);
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['required', 'exists:branches,id'],
            'name' => ['required', 'array'],
            'name.ar' => ['required', 'string', 'max:255'],
            'name.en' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route('user'))],
            'phone' => ['nullable', 'string', 'max:50'],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', 'exists:roles,name'],
            'is_active' => ['boolean'],

            'photo' => ['nullable', 'image', 'max:4096'],
            'is_team_visible' => ['boolean'],
            'category' => ['required_if:is_team_visible,1', 'nullable', 'in:partners,lawyers,admin_staff'],
            'sort_order' => ['integer', 'min:0'],
            'title' => ['required_if:is_team_visible,1', 'nullable', 'array'],
            'title.ar' => ['required_if:is_team_visible,1', 'nullable', 'string', 'max:255'],
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
        ];
    }
}
