<?php

namespace App\Http\Requests;

use App\Enums\TransactionTypeEnums;
use Illuminate\Foundation\Http\FormRequest;

class TransactioRequest extends FormRequest
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
        return [
            'customer_id' => 'required|exists:customers,id',
            'transaction_type' => 'required|string|in:' . implode(',', array_keys(TransactionTypeEnums::statuses())),
            'amount' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'The customer field is required.',
            'customer_id.exists' => 'The customer field is required.',
            'transaction_type.required' => 'The transaction type field is required.',
            'transaction_type.in' => 'The transaction type field is required.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount field is invalid.',
        ];
    }
}
