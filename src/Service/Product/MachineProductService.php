<?php


namespace App\Service\Product;


use App\Entity\AbstractProduct;
use App\Entity\Machine;
use App\Entity\Transport;
use App\Entity\TransportType;
use App\Repository\MachineRepository;

class MachineProductService implements ProductServiceInterface
{
    private $repository;

    public function __construct(MachineRepository $repository)
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
            $data['product'][] = Machine::createProduct($product);
        }

        $data['arrived'] = $dateTime;

        $data['transport_type'] = TransportType::transportType(TransportType::ARRIVED_BIG_TRUCK);

        $transport = new Transport();

        $transport->setTransportData($data);
    }

    /**
     * @param AbstractProduct[] $result
     * @param $dateTime
     */
    public function outgoProducts(array $result, $dateTime)
    {
        $data = [];

        $data['arrived'] = $dateTime;

        $data['transport_type'] = TransportType::transportType(TransportType::ARRIVED_BIG_TRUCK);

        $data['products'] = $result;

        $transport = new Transport();

        $transport->setTransportData($data);

        foreach($result as $product) {
            $product->outgoingTransport = $transport;
        }
    }


}