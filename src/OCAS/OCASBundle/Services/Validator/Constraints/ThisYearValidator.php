<?php
namespace OCAS\OCASBundle\Services\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ThisYearValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $this_year=date("Y-01-01");
        if ($value < $this_year) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}', $value)
                ->addViolation();
        }
    }
}
