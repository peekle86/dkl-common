<?php


namespace DKL\Constants;


class PaymentTypes
{
    const CASH = 'CASH';
    const BANK_TRANSFER = 'BANK_TRANSFER';
    const COD = 'COD';

    const ALL = [
        self::CASH,
        self::COD,
        self::BANK_TRANSFER,
    ];
}
