<?php


namespace App\Validator;


use App\Entity\Machine;
use App\Entity\Parcel;
use App\Entity\TransportType;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CsvConstraintValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if ($value['product'] instanceof Machine && $value['type'] != TransportType::ARRIVED_TRUCK) {
            $this->context->addViolation("Truck carry only parcel");
        } else if ($value['product'] instanceof Parcel && $value['type'] != TransportType::ARRIVED_BIG_TRUCK) {
            $this->context->addViolation("Big truck carry only machine");
        } else {
            $this->context->addViolation("Transport type is not supported");
        }
    }
}