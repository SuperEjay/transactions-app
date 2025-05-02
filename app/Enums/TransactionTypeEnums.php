<?php

namespace App\Enums;

enum TransactionTypeEnums: int
{
  case DEPOSIT = 1;
  case PAYMENT = 2;
  case CREDIT = 3;
  case REFUND = 4;

  public function label(): string
  {
    return match ($this) {
      self::DEPOSIT => 'Deposit',
      self::PAYMENT => 'Payment',
      self::CREDIT => 'Credit',
      self::REFUND => 'Refund',
    };
  }

  public static function statuses(): array
  {
    return [
      self::DEPOSIT->value => self::DEPOSIT->label(),
      self::PAYMENT->value => self::PAYMENT->label(),
      self::CREDIT->value => self::CREDIT->label(),
      self::REFUND->value => self::REFUND->label(),
    ];
  }
}
