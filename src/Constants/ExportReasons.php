<?php

namespace DKL\Constants;


class ExportReasons
{
    const MARKETING = "MARKETING";
    const SALES = "SALES";
    const SAMPLES_FOR_TESTING_ONLY = "SAMPLES_FOR_TESTING_ONLY";
    const RETURN_AFTER_REPAIRING = "RETURN_AFTER_REPAIRING";
    const REPAIRING = "REPAIRING";
    const PERSONAL_ITEMS = "PERSONAL_ITEMS";
    const GIFT = "GIFT";

    const ALL = [
        self::MARKETING,
        self::SALES,
        self::SAMPLES_FOR_TESTING_ONLY,
        self::RETURN_AFTER_REPAIRING,
        self::REPAIRING,
        self::PERSONAL_ITEMS,
        self::GIFT,
    ];
}
