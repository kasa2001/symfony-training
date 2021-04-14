<?php


namespace App\Controller;


use App\Repository\TransportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TransportController extends AbstractController
{

    /**
     * @Symfony\Component\Routing\Annotation\Route("/transport-show/{id}", name="transport-show", methods={"GET"})
     * @param TransportRepository $repository
     * @param int $id
     * @return Response
     */
    public function showTransport(TransportRepository $repository, int $id): Response
    {
        $transport = $repository->find($id);
        return $this->render(
            'form/result.html.twig',
            [
                'result' => $transport
            ]
        );
    }
}