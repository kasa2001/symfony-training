<?php


namespace App\Entity;


use DateTime;

abstract class AbstractProduct
{

    /**
     * @var int
     */
    public $id;

    /**
     * @var double
     */
    public $weight;

    /**
     * @var DateTime
     */
    public $createdDate;

    /**
     * @var Transport
     */
    public $incomingTransport;

    /**
     * @var Transport
     */
    public $outgoingTransport;

    public abstract static function createProduct(array $product): AbstractProduct;

}