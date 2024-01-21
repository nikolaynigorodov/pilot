<?php

namespace App\Helper;

class FlightStatusHelper
{
    const STATUS_AVAILABLE = 0;
    const STATUS_FLIGHT = 1;
    const STATUS_END_FLIGHT = 2;

    public static function getStatus($status)
    {
        switch ($status) {
            case self::STATUS_AVAILABLE:
                return "Available";
            case self::STATUS_FLIGHT:
                return "In Flight";
            case self::STATUS_END_FLIGHT:
                return "End of Flight";
        }
    }

    public static function getArrayStatus()
    {
        return [
            self::STATUS_AVAILABLE => 'Available',
            self::STATUS_FLIGHT => 'In Flight',
            self::STATUS_END_FLIGHT => 'End of Flight',
        ];
    }

    public static function getStatusWithColor($status)
    {
        switch ($status) {
            case self::STATUS_AVAILABLE:
                return "<span class=''>Available</span>";
            case self::STATUS_FLIGHT:
                return "<span class='text-danger'>In Flight</span>";
            case self::STATUS_END_FLIGHT:
                return "<span class='text-success'>End of Flight</span>";
        }
    }
}
