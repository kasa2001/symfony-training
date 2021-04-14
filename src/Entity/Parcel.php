<?php


namespace App\Entity;


use DateTime;

class Parcel extends AbstractProduct
{

    public static function createProduct(array $product): AbstractProduct
    {
        $machine = new Parcel();

        $machine->weight = $product['weight'];
        $machine->createdDate = new DateTime();

        return $machine;
    }

    /**
     * @param Transport $outgoingTransport
     */
    public function setOutgoingTransport(Transport $outgoingTransport): void
    {
        $this->outgoingTransport = $outgoingTransport;
    }


}