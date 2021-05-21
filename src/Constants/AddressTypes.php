<?php


namespace DKL\Constants;


class AddressTypes
{
    const SENDER = 'SENDER';
    const RECIPIENT = 'RECIPIENT';
    const THIRD_PARTY = 'THIRD_PARTY';

    const ALL = [
        self::SENDER,
        self::RECIPIENT,
        self::THIRD_PARTY,
    ];
}
