<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $customer = $this->route('customer')->id ?? null;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer,
            // 'wallet_balance' => 'required|numeric|min:0',
        ];
    }
}
