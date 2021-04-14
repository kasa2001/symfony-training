<?php


namespace App\Controller;


use App\Service\Product\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MachineController extends AbstractController
{

    /**
     * @Symfony\Component\Routing\Annotation\Route("/machine-show/{id}", name="machine-show", methods={"GET"})
     * @param ProductServiceInterface $productService
     * @param int $id
     * @return Response
     */
    public function showMachine(ProductServiceInterface $productService, int $id): Response
    {
        $machine = $productService->getProduct($id);
        return $this->render(
            'form/result.html.twig',
            [
                'result' => $machine
            ]
        );
    }
}