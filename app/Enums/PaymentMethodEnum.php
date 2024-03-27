<?php

namespace App\Enums;

class PaymentMethodEnum
{
    public const CASH = "cash";
    public const ONLINE = "online";
    public const CHEQUES = "cheques";
    public const BANK_ACCOUNT = "bankAccount";

    public static function getValues(): array
    {
        return [
            self::CASH,
            self::ONLINE,
            self::CHEQUES,
            self::BANK_ACCOUNT,
        ];
    }
}
