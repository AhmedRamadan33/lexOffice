<?php

namespace App\Http\Requests\CaseModel;

use Illuminate\Foundation\Http\FormRequest;

class StoreCaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'court_id' => ['nullable', 'exists:courts,id'],
            'case_type_id' => ['nullable', 'exists:case_types,id'],
            'opponent_name' => ['nullable', 'array'],
            'opponent_name.ar' => ['nullable', 'string', 'max:255'],
            'opponent_name.en' => ['nullable', 'string', 'max:255'],
            'opponent_phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'array'],
            'subject.ar' => ['nullable', 'string', 'max:255'],
            'subject.en' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:open,pending,closed'],
            'assigned_lawyer_id' => ['nullable', 'exists:users,id'],
            'start_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'array'],
            'notes.ar' => ['nullable', 'string'],
            'notes.en' => ['nullable', 'string'],
        ];
    }
}
