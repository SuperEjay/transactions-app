@extends('layout')
@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold">Apply Discount</h3>
            <a href="/invoices" class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 text-[12px]">
                <i class="fa-solid fa-arrow-left"></i>
                Back
            </a>
        </div>

        <div class="max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
            <form action="{{ route('invoices.applyDiscount', $invoice['id']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-2">
                    <p class="text-sm font-bold">Discount Information</p>
                    <hr />

                    <div class="flex flex-col gap-4 mt-5">
                        <div class="flex flex-col gap-2">
                            <label for="discount" class="text-[14px] font-medium">Discount</label>
                            <input type="number" class="border-2 rounded-md w-full py-1 px-2 bg-white border-gray-500/30 focus:border-gray-500/50 focus:outline-none {{ $errors->has('discount') ? 'border-red-500' : '' }}" id="discount" name="discount" value="{{ old('discount', $invoice['discount']) }}">

                            @error('discount')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex flex-col justify-end items-end gap-2 mt-5">
                            <button type="submit" class="bg-black text-white py-2 px-2 rounded-md flex items-center gap-2 text-[12px]">
                                <i class="fa-solid fa-check"></i>
                                Apply Discount
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection
