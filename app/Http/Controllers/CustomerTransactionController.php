<?php

namespace App\Http\Controllers;

use App\Enums\TransactionTypeEnums;
use App\Http\Requests\TransactioRequest;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CustomerTransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all()->map(function ($transaction) {
            return [
                'id' => $transaction->id,
                'customer' => $transaction->customer->name,
                'transaction_type' => TransactionTypeEnums::from($transaction->transaction_type)->label(),
                'amount' => number_format($transaction->amount, 2),
            ];
        });

        return view('transactions.index')->with([
            'transactions' => $transactions,
        ]);
    }

    public function create()
    {
        $customers = Customer::all()->map(function ($customer) {
            return [
                'id' => $customer->id,
                'name' => $customer->name,
            ];
        });

        $transactionTypes = TransactionTypeEnums::statuses();

        return view('transactions.create')->with([
            'customers' => $customers,
            'transactionTypes' => $transactionTypes,
        ]);
    }

    public function store(TransactioRequest $request)
    {
        $validated = $request->validated();
        $validated['transaction_type'] = TransactionTypeEnums::from($validated['transaction_type'])->value;

        Transaction::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully');
    }

    public function edit(Transaction $transaction)
    {
        $customers = Customer::all()->map(function ($customer) {
            return [
                'id' => $customer->id,
                'name' => $customer->name,
            ];
        });

        $transactionTypes = TransactionTypeEnums::statuses();

        return view('transactions.edit')->with([
            'customers' => $customers,
            'transactionTypes' => $transactionTypes,
            'transaction' => $transaction,
        ]);
    }

    public function update(TransactioRequest $request, Transaction $transaction)
    {
        $validated = $request->validated();
        $validated['transaction_type'] = TransactionTypeEnums::from($validated['transaction_type'])->value;

        $transaction->update($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully');
    }
}
