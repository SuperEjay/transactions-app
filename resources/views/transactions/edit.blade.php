@extends('layout')
@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold">Edit Transaction</h3>
            <a href="/transactions" class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 text-[12px]">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>
        </div>

        <div class="max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-2">
                    <p class="text-sm font-bold">Transaction Information</p>
                    <hr />

                    <div class="flex flex-col gap-4 mt-5">
                        <div class="flex flex-col gap-2">
                            <label for="customer_id" class="text-[14px] font-medium">Customer</label>
                            <select id="customer_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2 {{ $errors->has('customer_id') ? 'border-red-500' : '' }}" name="customer_id">
                                <option selected>Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer['id'] }}" {{ $transaction->customer_id == $customer['id'] ? 'selected' : '' }}>{{ $customer['name'] }}</option>
                                @endforeach
                            </select>

                            @error('customer_id')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="transaction_type" class="text-[14px] font-medium">Transaction Type</label>
                            <select id="transaction_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2 {{ $errors->has('transaction_type') ? 'border-red-500' : '' }}" name="transaction_type">
                                <option selected>Select Transaction Type</option>
                                @foreach ($transactionTypes as $key => $transactionType)
                                    <option value="{{ $key }}" {{ $transaction->transaction_type == $key ? 'selected' : '' }}>{{ $transactionType }}</option>
                                @endforeach
                            </select>

                            @error('transaction_type')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="amount" class="text-[14px] font-medium">Amount</label>
                            <input type="number" class="border-2 rounded-md w-full py-1 px-2 bg-white border-gray-500/30 focus:border-gray-500/50 focus:outline-none {{ $errors->has('amount') ? 'border-red-500' : '' }}" id="amount" name="amount" value="{{ old('amount', $transaction->amount) }}">

                            @error('amount')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col justify-end items-end gap-2 mt-5">
                            <button type="submit" class="bg-black text-white py-2 px-4 rounded-md flex items-center gap-2 text-[12px]">
                                <i class="fa-solid fa-check"></i>
                                Update Transaction
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
