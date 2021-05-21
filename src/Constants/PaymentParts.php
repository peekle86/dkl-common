<?php


namespace DKL\Constants;


class PaymentParts
{
    const SENDER = 'SENDER';
    const RECIPIENT = 'RECIPIENT';
    const RECEIVER = 'RECEIVER';
    const THIRD_PARTY = 'THIRD_PARTY';

    const ALL = [
        self::SENDER,
        self::RECIPIENT,
        self::THIRD_PARTY,
    ];
}
