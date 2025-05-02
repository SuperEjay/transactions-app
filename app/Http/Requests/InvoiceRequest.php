<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $invoice = $this->route('invoice') ?? null;

        return [
            'customer_id' => 'required|exists:customers,id',
            'reference_number' => 'required|string|max:255',
            'amount' => 'required|numeric|min:' . ($invoice ? $invoice->discount : 0),
        ];
    }

    public function messages(): array
    {
        $invoice = $this->route('invoice') ?? null;

        return [
            'customer_id.required' => 'The customer field is required.',
            'customer_id.exists' => 'The customer field is required.',
            'reference_number.required' => 'The reference number field is required.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'amount.min' => 'The amount must be at least ' . ($invoice ? $invoice->discount : 0) . '.',
        ];
    }
}
