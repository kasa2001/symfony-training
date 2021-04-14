<?php


namespace App\Service\Form\Adapter;


use App\Service\Parser\ParserServiceInterface;
use Symfony\Component\Form\FormInterface;

interface FormAdapterInterface
{
    function doAdapter(FormInterface $form);
}