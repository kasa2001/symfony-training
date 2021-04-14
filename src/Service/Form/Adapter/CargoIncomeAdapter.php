<?php


namespace App\Service\Form\Adapter;


use App\Exception\AbstractFileException;
use App\Exception\FileRecordException;
use App\Model\CsvFile;
use App\Service\Parser\ParserServiceInterface;
use App\Service\Product\ProductServiceInterface;
use App\Validator\CsvConstraint;
use Exception;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CargoIncomeAdapter implements FormAdapterInterface
{
    use AdapterTrait;

    /**
     * @var ParserServiceInterface
     */
    private $parserService;

    /**
     * @var ProductServiceInterface
     */
    private $productService;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(
        ParserServiceInterface $parserService,
        ProductServiceInterface $productService
    )
    {
        $this->parserService = $parserService;
        $this->productService = $productService;
        $this->validator = Validation::createValidator();
    }

    /**
     * @param FormInterface $form
     * @return array
     * @throws AbstractFileException
     * @throws Exception
     */
    public function doAdapter(FormInterface $form): array
    {
        $content = $this->loadFile($form, CsvFile::class);

        $result = [];

        foreach ($content as $item) {
            $parsedRecord = $this->parserService->parse($item);

            $valid = $this->validator->validate(
                $parsedRecord,
                [
                    new CsvConstraint()
                ]
            );

            if ($valid->count()) {
                throw new FileRecordException();
            }

            $result[] = $parsedRecord;

        }

        $this->productService->saveProducts(
            $result,
            $form->get('arrived')
        );

        return $result;
    }


    /**
     * @param $csv
     * @param $expected
     * @return int
     */
    private function compareHeader($csv, $expected): int
    {
        return count(array_diff($csv, $expected));
    }
}