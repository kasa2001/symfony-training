<?php


namespace App\Service\Product;


use App\Entity\Parcel;
use App\Entity\Transport;
use App\Entity\TransportType;
use App\Repository\ParcelRepository;

class ParcelProductService implements ProductServiceInterface
{
    private $repository;

    public function __construct(ParcelRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getProduct($id): ?object
    {
        return $this->repository->find($id);
    }

    public function saveProducts(array $result, $dateTime)
    {
        $data = [];

        foreach ($result as $product) {
            $data['product'][] = Parcel::createProduct($product);
        }

        $data['arrived'] = $dateTime;

        $data['transport_type'] = TransportType::transportType(TransportType::ARRIVED_TRUCK);

        $transport = new Transport();

        $transport->setTransportData($data);
    }

    public function outgoProducts(array $result, $dateTime)
    {
        // TODO: Implement outgoProducts() method.
    }

}