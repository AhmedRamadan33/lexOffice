<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'array'],
            'name.ar' => ['required', 'string', 'max:255'],
            'name.en' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'in:individual,company'],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255', Rule::unique('clients', 'email')->ignore($this->route('client'))],
            'national_id' => ['required', 'string', 'max:50', Rule::unique('clients', 'national_id')->ignore($this->route('client'))],
            'address' => ['nullable', 'array'],
            'address.ar' => ['nullable', 'string'],
            'address.en' => ['nullable', 'string'],
            'notes' => ['nullable', 'array'],
            'notes.ar' => ['nullable', 'string'],
            'notes.en' => ['nullable', 'string'],
        ];
    }
}
