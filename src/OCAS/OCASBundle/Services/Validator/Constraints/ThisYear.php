<?php
namespace OCAS\OCASBundle\Services\Validator\Constraints;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ThisYear extends Constraint
{
    public $message = "L'annnée de création n'est pas celle attendue";
}
