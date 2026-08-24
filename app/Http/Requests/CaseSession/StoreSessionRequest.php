<?php

namespace App\Http\Requests\CaseSession;

use Illuminate\Foundation\Http\FormRequest;

class StoreSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'court_id' => ['nullable', 'exists:courts,id'],
            'session_date' => ['required', 'date'],
            'session_time' => ['nullable', 'date_format:H:i'],
            'judge_name' => ['nullable', 'array'],
            'judge_name.ar' => ['nullable', 'string', 'max:255'],
            'judge_name.en' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'array'],
            'notes.ar' => ['nullable', 'string'],
            'notes.en' => ['nullable', 'string'],
            'decision' => ['nullable', 'array'],
            'decision.ar' => ['nullable', 'string'],
            'decision.en' => ['nullable', 'string'],
            'next_session_date' => ['nullable', 'date'],
            'status' => ['required', 'in:scheduled,held,postponed'],
        ];
    }
}
