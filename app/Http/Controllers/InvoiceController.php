<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiscountRequest;
use App\Http\Requests\InvoiceRequest;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all()->map(function ($invoice) {
            return [
                'id' => $invoice->id,
                'reference_number' => $invoice->reference_number,
                'customer' => $invoice->customer->name,
                'amount' => number_format($invoice->amount, 2),
                'discount' => number_format($invoice->discount, 2),
                'total' => number_format($invoice->amount - $invoice->discount, 2),
            ];
        });
        return view('invoice.index')->with('invoices', $invoices);
    }

    public function create()
    {
        $customers = Customer::all()->map(function ($customer) {
            return [
                'id' => $customer->id,
                'name' => $customer->name,
            ];
        });

        return view('invoice.create')->with('customers', $customers);
    }

    public function store(InvoiceRequest $request)
    {
        $validated = $request->validated();

        Invoice::create($validated);

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully');
    }

    public function discount(Invoice $invoice)
    {
        return view('invoice.discount')->with('invoice', $invoice);
    }

    public function edit(Invoice $invoice)
    {
        $customers = Customer::all()->map(function ($customer) {
            return [
                'id' => $customer->id,
                'name' => $customer->name,
            ];
        });

        return view('invoice.edit')->with([
            'invoice' => $invoice,
            'customers' => $customers,
        ]);
    }

    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $validated = $request->validated();
        $invoice->update($validated);
        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully');
    }

    public function applyDiscount(Invoice $invoice, DiscountRequest $request)
    {
        $validated = $request->validated();
        $invoice->update([
            'discount' => $validated['discount'],
        ]);

        return redirect()->route('invoices.index')->with('success', 'Discount applied successfully');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully');
    }
}
