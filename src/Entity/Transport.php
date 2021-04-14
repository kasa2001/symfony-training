<?php


namespace App\Entity;


use DateTime;

class Transport
{

    /**
     * @var int
     */
    public $id;

    /**
     * @var DateTime
     */
    public $arrivedDate;

    /**
     * @var DateTime
     */
    public $leftDate;

    /**
     * @var AbstractProduct[]
     */
    public $products;

    /**
     * @var TransportType
     */
    public $transportType;

    public function setTransportData(array $data)
    {
        $this->arrivedDate = $data['arrived'];
        $this->transportType = $data['transport_type'];
        $this->products = $data['products'];
    }
}