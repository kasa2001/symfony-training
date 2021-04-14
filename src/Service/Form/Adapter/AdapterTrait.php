<?php


namespace App\Service\Form\Adapter;


use App\Exception\FileExtensionException;
use App\Exception\HeaderFileException;
use Exception;
use ReflectionClass;

trait AdapterTrait
{

    /**
     * @param $form
     * @param $csvClass
     * @return mixed
     * @throws Exception
     */
    public function loadFile($form, $csvClass)
    {
        $file = $form->get('file')->getData();

        if ($file->getClientOriginalExtension() !== 'csv') {
            throw new FileExtensionException();
        }

        $content = $this->parserService->parseFile($file->getContent());

        $header = $this->parserService->parseHeader($content[0]);

        $csv = new ReflectionClass($csvClass);

        if ($this->compareHeader($header, array_keys($csv->getDefaultProperties()))) {
            throw new HeaderFileException();
        }

        unset($content[0]);

        return $content;
    }
}