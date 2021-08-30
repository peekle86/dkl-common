<?php

namespace DKL\Helpers;

use DKL\Constants\DeliveryTypes;

class ParcelHelpers
{
    public static function volumetricWeight($deliveryType, $places)
    {
        $divider = in_array($deliveryType, DeliveryTypes::AIR_DELIVERY_TYPES) ? 6000 : 5000;
        return $places->sum(
            function ($place) use ($deliveryType, $divider) {
                $quantity = $place['quantity'] ?? 0;
                $x = $place['x'] ?? 0;
                $y = $place['y'] ?? 0;
                $z = $place['z'] ?? 0;
                $totalWeight = 0;
                if ($deliveryType == DeliveryTypes::ROAD_EXPRESS) {
                    $totalWeight += ($x / 100) * ($y / 100) * ($z / 100) * 333 * $quantity;
                } else {
                    $totalWeight = ($x * $y * $z / $divider) * $quantity;
                }
                return number_format($totalWeight, 2);
            }
        );
    }
}