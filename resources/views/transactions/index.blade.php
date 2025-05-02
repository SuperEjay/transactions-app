@extends('layout')
@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold">Customer Transactions</h3>
            <a href="/transactions/create" class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 text-[12px]">
                <i class="fa-solid fa-plus"></i>
                New Transaction
            </a>
        </div>

        <div class="relative overflow-x-auto border-2 rounded-md border-gray-200">
            <table class="w-full text-sm text-left text-black">
                <thead class="text-xs text-black uppercase border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-4 py-3">
                            Customer
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Transaction Type
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Amount
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($transactions->count() > 0)
                        @foreach ($transactions as $transaction)
                            <tr class="odd:bg-white even:bg-gray-100 border-b border-gray-200 text-[14px] text-gray-500">
                                <td class="px-4 py-3">
                                    {{ $transaction['customer'] }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $transaction['transaction_type'] }}
                                </td>
                                <td class="px-4 py-3">
                                    Php {{ $transaction['amount'] }}
                                </td>

                                <td class="px-4 py-3 flex items-center gap-2">
                                    <a href="/transactions/{{ $transaction['id'] }}" class="font-medium text-amber-500 hover:underline border rounded-md px-2 py-1">
                                        <i class="fa-solid fa-pen-to-square"></i>`
                                    </a>

                                    <form action="{{ route('transactions.destroy', $transaction['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-500 hover:underline border rounded-md px-2 py-1">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="odd:bg-white even:bg-gray-100 border-b border-gray-200 text-[12px] text-gray-500">
                            <td colspan="4" class="px-4 py-3 text-center">
                                No data found.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
