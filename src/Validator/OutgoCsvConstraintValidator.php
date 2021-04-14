<?php


namespace App\Validator;


use App\Entity\Machine;
use App\Entity\Parcel;
use App\Entity\TransportType;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class OutgoCsvConstraintValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if ($value['product'] instanceof Machine && $value['type'] != TransportType::LEAVE_PLANE) {
            $this->context->addViolation("Car carry only parcel");
        } else if ($value['product'] instanceof Parcel && $value['type'] != TransportType::LEAVE_CAR) {
            $this->context->addViolation("Plane carry only machine");
        } else {
            $this->context->addViolation("Transport type is not supported");
        }
    }

}