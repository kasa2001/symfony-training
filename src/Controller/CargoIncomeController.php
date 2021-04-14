<?php


namespace App\Controller;


use App\Form\CargoData;
use App\Service\Form\FormServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CargoIncomeController extends AbstractController
{

    /**
     * @Symfony\Component\Routing\Annotation\Route("/parcel-form", name="parcel-form", methods={"GET"})
     * @param FormServiceInterface $formService
     * @return Response
     */
    public function parcelCargo(FormServiceInterface $formService): Response
    {
        return $this->render(
            'form/income_cargo.html.twig',
            [
                'form' => $formService->renderForm(
                    $this->createForm(
                        CargoData::class
                    )
                )
            ]
        );
    }

    /**
     * @Symfony\Component\Routing\Annotation\Route("/machine-form", name="machine-form", methods={"GET"})
     * @param FormServiceInterface $formService
     * @return Response
     */
    public function machineCargo(FormServiceInterface $formService): Response
    {
        return $this->render(
            'form/income_cargo.html.twig',
            [
                'form' => $formService->renderForm(
                    $this->createForm(
                        CargoData::class
                    )
                )
            ]
        );
    }

    /**
     * @Symfony\Component\Routing\Annotation\Route("/parcel-form", name="parcel-form-post", methods={"POST"})
     * @param FormServiceInterface $formService
     * @param Request $request
     * @return Response
     */
    public function registryParcelCargo(FormServiceInterface $formService, Request $request): Response
    {
        $form = $this->createForm(CargoData::class);

        if (($result = $formService->processForm($form, $request))) {
            return $this->render(
                'form/result.html.twig',
                [
                    'result' => $result
                ]
            );
        }

        return $this->render(
            'form/income_cargo.html.twig',
            [
                'form' => $formService->renderForm(
                    $form
                )
            ]
        );
    }

    /**
     * @Symfony\Component\Routing\Annotation\Route("/machine-form", name="machine-form-post", methods={"POST"})
     * @param FormServiceInterface $formService
     * @param Request $request
     * @return Response
     */
    public function registryMachineCargo(FormServiceInterface $formService, Request $request): Response
    {
        $form = $this->createForm(CargoData::class);

        if (($result = $formService->processForm($form, $request))) {
            return $this->render(
                'form/result.html.twig',
                [
                    'result' => $result
                ]
            );
        }

        return $this->render(
            'form/income_cargo.html.twig',
            [
                'form' => $formService->renderForm(
                    $form
                )
            ]
        );
    }
}