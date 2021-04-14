<?php


namespace App\Controller;


use App\Form\LoaCargoCar;
use App\Form\LoadCargoPlane;
use App\Service\Form\FormServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CargoOutgoController extends AbstractController
{

    /**
     * @Symfony\Component\Routing\Annotation\Route("/parcel-outgo-form", name="parcel-outgo-form", methods={"GET"})
     * @param FormServiceInterface $formService
     * @return Response
     */
    public function loadParcel(FormServiceInterface $formService): Response
    {
        return $this->render(
            'form/outgo_cargo.html.twig',
            [
                'form' => $formService->renderForm(
                    $this->createForm(
                        LoaCargoCar::class
                    )
                )
            ]
        );
    }

    /**
     * @Symfony\Component\Routing\Annotation\Route("/machine-outgo-form", name="machine-outgo-form", methods={"GET"})
     * @param FormServiceInterface $formService
     * @return Response
     */
    public function loadMachine(FormServiceInterface $formService): Response
    {
        return $this->render(
            'form/outgo_cargo.html.twig',
            [
                'form' => $formService->renderForm(
                    $this->createForm(
                        LoadCargoPlane::class
                    )
                )
            ]
        );
    }

    /**
     * @Symfony\Component\Routing\Annotation\Route("/parcel-outgo-form-action", name="parcel-outgo-form-action", methods={"POST"})
     * @param FormServiceInterface $formService
     * @param Request $request
     * @return Response
     */
    public function loadParcelAction(FormServiceInterface $formService, Request $request): Response
    {
        $form = $this->createForm(LoaCargoCar::class);

        if (($result = $formService->processForm($form, $request))) {
            return $this->render(
                'form/result.html.twig',
                [
                    'result' => $result
                ]
            );
        }

        return $this->render(
            'form/outgo_cargo.html.twig',
            [
                'form' => $formService->renderForm(
                    $form
                )
            ]
        );
    }

    /**
     * @Symfony\Component\Routing\Annotation\Route("/machine-outgo-form-action", name="machine-outgo-form-action", methods={"POST"})
     * @param FormServiceInterface $formService
     * @param Request $request
     * @return Response
     */
    public function loadMachineAction(FormServiceInterface $formService, Request $request): Response
    {
        $form = $this->createForm(LoadCargoPlane::class);

        if (($result = $formService->processForm($form, $request))) {
            return $this->render(
                'form/result.html.twig',
                [
                    'result' => $result
                ]
            );
        }

        return $this->render(
            'form/outgo_cargo.html.twig',
            [
                'form' => $formService->renderForm(
                    $form
                )
            ]
        );
    }

}