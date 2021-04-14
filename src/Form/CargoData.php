<?php


namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class CargoData extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'arrived',
            DateType::class,
            [
                'label' => "Arrived",
                'required' => false,
            ]
        );

        $builder->add(
            'file',
            FileType::class,
            [
                'label' => "Cargo",
                'required' => true,
                'constraints' => [
                    new File(
                        [
                        'maxSize' => '2048k',
                        'mimeTypesMessage' => 'Too big file',
                        ]
                    )
                ],
            ]
        );

        $builder->add(
            'send',
            SubmitType::class,
            [
                'label' => 'Send data',
            ]
        );

        parent::buildForm($builder, $options);
    }
}