<?php

namespace App\Http\Controllers;

use App\Enums\TransactionTypeEnums;
use App\Http\Requests\TransactioRequest;
use App\Models\Customer;
use App\Models\Transaction;
use App\Services\PHPMailerService;
use Illuminate\Http\Request;

class CustomerTransactionController extends Controller
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailerService();
    }

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

        $transaction = Transaction::create($validated);

        $this->mailer->sendEmail($transaction->customer->email, 'Successful Transaction', 'emails.transaction', [
            'customers' => $transaction->customer->name,
            'transactionTypes' => TransactionTypeEnums::from($transaction->transaction_type)->label(),
            'transactionDate' => date('F d, Y H:i:s', strtotime($transaction->created_at)),
            'transactionAmount' => number_format($transaction->amount, 2),
        ]);

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
