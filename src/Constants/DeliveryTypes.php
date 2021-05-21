<?php


namespace DKL\Constants;


class DeliveryTypes
{
    const EXPORT_COURIER_STANDARD = 'EXPORT_COURIER_STANDARD';
    const EXPORT_COURIER_SPECIAL = 'EXPORT_COURIER_SPECIAL';
    const EXPORT_AIR_FREIGHT_DOOR_TO_DOOR = 'EXPORT_AIR_FREIGHT_DOOR_TO_DOOR';
    const EXPORT_AIR_FREIGHT_AIRPORT_TO_AIRPORT = 'EXPORT_AIR_FREIGHT_AIRPORT_TO_AIRPORT';
    const EXPORT_AIR_FREIGHT_DOOR_TO_AIRPORT = 'EXPORT_AIR_FREIGHT_DOOR_TO_AIRPORT';
    const ROAD_FREIGHT = 'ROAD_FREIGHT';
    const ROAD_EXPRESS = 'ROAD_EXPRESS';

    const ALL = [
        self::EXPORT_COURIER_STANDARD,
        self::EXPORT_COURIER_SPECIAL,
        self::EXPORT_AIR_FREIGHT_DOOR_TO_DOOR,
        self::EXPORT_AIR_FREIGHT_AIRPORT_TO_AIRPORT,
        self::EXPORT_AIR_FREIGHT_DOOR_TO_AIRPORT,
        self::ROAD_FREIGHT,
    ];

    const PDF = [
        self::EXPORT_COURIER_STANDARD => "Export courier standard",
        self::EXPORT_COURIER_SPECIAL => "Export courier special",
        self::EXPORT_AIR_FREIGHT_DOOR_TO_DOOR => "Export Air freight<br/> door-to-door",
        self::EXPORT_AIR_FREIGHT_AIRPORT_TO_AIRPORT => "Export Air freight<br/> airport-to-airport",
        self::EXPORT_AIR_FREIGHT_DOOR_TO_AIRPORT => "Export Air freight<br/> door-to-airport",
        self::ROAD_FREIGHT => "Road freight",
    ];
}
