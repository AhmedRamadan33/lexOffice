<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'min:0.01'],
            'paid_at' => ['required', 'date'],
            'method' => ['required', 'in:cash,bank_transfer,cheque,card,other'],
            'notes' => ['nullable', 'array'],
            'notes.ar' => ['nullable', 'string'],
            'notes.en' => ['nullable', 'string'],
        ];
    }
}
