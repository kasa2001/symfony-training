<?php


namespace App\Controller;


use App\Service\Product\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ParcelController extends AbstractController
{

    /**
     * @Symfony\Component\Routing\Annotation\Route("/parcel-show/{id}", name="parcel-show", methods={"GET"})
     * @param ProductServiceInterface $productService
     * @param int $id
     * @return Response
     */
    public function showParcel(ProductServiceInterface $productService, int $id): Response
    {
        $parcel = $productService->getProduct($id);
        return $this->render(
            'form/result.html.twig',
            [
                'result' => $parcel
            ]
        );
    }
}