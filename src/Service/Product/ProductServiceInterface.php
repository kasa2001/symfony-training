<?php


namespace App\Service\Product;


use Symfony\Component\Form\Extension\Core\Type\DateType;

interface ProductServiceInterface
{

    public function getProduct($id);

    public function saveProducts(array $result, $dateTime);

    public function outgoProducts(array $result, $dateTime);
}