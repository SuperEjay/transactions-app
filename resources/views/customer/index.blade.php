@extends('layout')
@section('content')
    <div class="flex flex-col gap-4">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-bold">Customers</h3>
            <a href="/customers/create" class="bg-black text-white px-4 py-2 rounded-md flex items-center gap-2 text-[12px]">
                <i class="fa-solid fa-plus"></i>
                New Customer
            </a>
        </div>

        <div class="relative overflow-x-auto border-2 rounded-md border-gray-200">
            <table class="w-full text-sm text-left text-black">
                <thead class="text-xs text-black uppercase border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-4 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Wallet Balance
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($customers->count() > 0)
                        @foreach ($customers as $customer)
                            <tr class="odd:bg-white even:bg-gray-100 border-b border-gray-200 text-[14px] text-gray-500">
                                <td class="px-4 py-3">
                                    {{ $customer['name'] }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $customer['email'] }}
                                </td>
                                <td class="px-4 py-3">
                                    Php {{ $customer['balance'] }}
                                </td>
                                <td class="px-4 py-3 flex items-center gap-2">
                                    <a href="/customers/{{ $customer['id'] }}" class="font-medium text-amber-500 hover:underline border rounded-md px-2 py-1">
                                        <i class="fa-solid fa-pen-to-square"></i>`
                                    </a>
                                    <form action="{{ route('customers.destroy', $customer['id']) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');" style="display:inline;">
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
