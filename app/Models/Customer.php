<?php

namespace App\Models;

use App\Enums\TransactionTypeEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'balance',
    ];

    protected $appends = [
        'total_deposit',
        'total_payment',
        'total_credit',
        'total_refund',
        'balance',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getTotalDepositAttribute()
    {
        return $this->transactions()->where('transaction_type', TransactionTypeEnums::DEPOSIT->value)->sum('amount');
    }

    public function getTotalPaymentAttribute()
    {
        return $this->transactions()->where('transaction_type', TransactionTypeEnums::PAYMENT->value)->sum('amount');
    }

    public function getTotalCreditAttribute()
    {
        return $this->transactions()->where('transaction_type', TransactionTypeEnums::CREDIT->value)->sum('amount');
    }

    public function getTotalRefundAttribute()
    {
        return $this->transactions()->where('transaction_type', TransactionTypeEnums::REFUND->value)->sum('amount');
    }

    public function getBalanceAttribute()
    {
        return ($this->total_deposit + $this->total_credit + $this->total_refund) - $this->total_payment;
    }
}
