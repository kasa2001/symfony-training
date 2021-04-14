<?php


namespace App\Form;


use App\Entity\TransportType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

class LoaCargoCar extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'leave',
            DateType::class,
            [
                'label' => "Leave",
                'required' => false,
            ]
        );

        $builder->add(
            'transport_type',
            TextType::class,
            [
                'empty_data' => TransportType::LEAVE_CAR
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