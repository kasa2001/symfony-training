<?php


namespace App\Service\Form\Adapter;


use App\Entity\TransportType;
use App\Exception\AbstractFileException;
use App\Exception\FileRecordException;
use App\Exception\TooBigTransportException;
use App\Exception\WrongProductTypeException;
use App\Model\OutgoCsv;
use App\Service\Parser\ParserServiceInterface;
use App\Service\Product\ProductServiceInterface;
use App\Validator\OutgoCsvConstraint;
use Exception;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class CargoOutgoAdapter implements FormAdapterInterface
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

    private $weight = [
        TransportType::LEAVE_CAR => '200',
    ];

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
        $content = $this->loadFile($form, OutgoCsv::class);

        $result = [];

        $size = 0.0;

        $transportType = $form->get('transport_type');

        foreach ($content as $item) {
            $id = $this->parserService->parse($item);

            if (!is_int($id)) {
                throw new FileRecordException();
            }

            $product = $this->productService->getProduct($id);

            $valid = $this->validator->validate(
                [
                    'product' => $product,
                    'type' => $transportType
                ],
                [
                    new OutgoCsvConstraint()
                ]
            );

            if ($valid->count()) {
                throw new WrongProductTypeException();
            }

            $result[] = $product;

            $size += $product->weight;
        }

        $this->checkWeight($size, $transportType);

        $this->productService->outgoProducts(
            $result,
            $form->get('leave')
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

    /**
     * @param float $weight
     * @param $transportType
     * @throws TooBigTransportException
     */
    private function checkWeight(float $weight, $transportType)
    {
        if (isset($this->weight[$transportType]) && $weight > $this->weight[$transportType]) {
            throw new TooBigTransportException();
        }
    }
}