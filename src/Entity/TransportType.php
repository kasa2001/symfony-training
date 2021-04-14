<?php


namespace App\Entity;


class TransportType
{
    const ARRIVED_TRUCK = 'truck';
    const ARRIVED_BIG_TRUCK = 'big truck';
    const LEAVE_CAR = 'car';
    const LEAVE_PLANE = 'plane';

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $type;

    public static function transportType($type): TransportType
    {
        $transportType = new TransportType();

        $transportType->type = $type;

        return $transportType;
    }
}