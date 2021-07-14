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
                $totalWeight = 0;
                if ($deliveryType == DeliveryTypes::ROAD_EXPRESS) {
                    $totalWeight += ($place->x / 100) * ($place->y / 100) * ($place->z / 100) * 333 * $place->quantity;
                } else {
                    $totalWeight = ($place->x * $place->y * $place->z / $divider) * $place->quantity;
                }
                return number_format($totalWeight, 2);
            }
        );
    }
}