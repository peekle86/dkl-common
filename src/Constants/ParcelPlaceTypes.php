<?php


namespace DKL\Constants;


class ParcelPlaceTypes
{
    const ENVELOPE = 'ENVELOPE';
    const PACKAGE = 'PACKAGE';
    const BOX = 'BOX';
    const PALLET = 'PALLET';
    const PARCEL = 'PARCEL';

    const ALL = [
        self::ENVELOPE,
        self::PACKAGE,
        self::BOX,
        self::PALLET,
        self::PARCEL,
    ];
}
