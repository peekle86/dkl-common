<?php

namespace DKL\Constants;

class TrackingStatuses
{

    const PROCESSING = 0;
    const PICKED_UP = 1;
    const IN_TRANSIT = 2;
    const RETURNED = 3;
    const BILLING_INFORMATION_RECEIVED = 4;
    const DELIVERED = 10;

    const ALL = [
        [
            'id' => self::PROCESSING,
            'name' => 'Processing',
        ],
        [
            'id' => self::PICKED_UP,
            'name' => 'Picked up',
        ],
        [
            'id' => self::IN_TRANSIT,
            'name' => 'In transit',
        ],
        [
            'id' => self::RETURNED,
            'name' => 'Returned',
        ],
        [
            'id' => self::BILLING_INFORMATION_RECEIVED,
            'name' => 'BILLING INFORMATION RECEIVED',
        ],
        [
            'id' => self::DELIVERED,
            'name' => 'Delivered',
        ],
    ];
}
