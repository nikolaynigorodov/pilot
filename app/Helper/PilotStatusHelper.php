<?php

namespace App\Helper;

class PilotStatusHelper
{
    const STATUS_AVAILABLE = 0;
    const STATUS_FLIGHT = 1;
    const STATUS_RESERVATION = 2;

    public static function getStatus($status)
    {
        switch ($status) {
            case self::STATUS_AVAILABLE:
                return "Available";
            case self::STATUS_FLIGHT:
                return "In Flight";
            case self::STATUS_RESERVATION:
                return "Reservation";
        }
    }
}
