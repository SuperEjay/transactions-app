@extends('layout')
@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold">Edit Customer</h3>
            <a href="/customers" class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 text-[12px]">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>
        </div>

        <div class="max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <form action="{{ route('customers.update', $customer['id']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-2">
                    <p class="text-sm font-bold">Customer Information</p>
                    <hr />

                    <div class="flex flex-col gap-4 mt-5">
                        <div class="flex flex-col gap-2">
                            <label for="name" class="text-[14px] font-medium">Name</label>
                            <input type="text" class="border-2 rounded-md w-full py-1 px-2 bg-white border-gray-500/30 focus:border-gray-500/50 focus:outline-none {{ $errors->has('name') ? 'border-red-500' : '' }}" id="name" name="name" value="{{ old('name', $customer['name']) }}">

                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-[14px] font-medium">Email</label>
                            <input type="text" class="border-2 rounded-md w-full py-1 px-2 bg-white border-gray-500/30 focus:border-gray-500/50 focus:outline-none {{ $errors->has('email') ? 'border-red-500' : '' }}" id="email" name="email" value="{{ old('email', $customer['email']) }}">

                            @error('email')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-2">
                            <label for="wallet_balance" class="text-[14px] font-medium">Wallet Balance</label>
                            <input type="number" class="border-2 rounded-md w-full py-1 px-2 bg-white border-gray-500/30 focus:border-gray-500/50 focus:outline-none {{ $errors->has('wallet_balance') ? 'border-red-500' : '' }}" id="wallet_balance" name="wallet_balance" value="{{ old('wallet_balance', $customer['balance']) }}" disabled>

                            @error('wallet_balance')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col justify-end items-end gap-2 mt-5">
                        <button type="submit" class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 text-[12px]">
                            <i class="fa-solid fa-check"></i>
                            Update Customer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
