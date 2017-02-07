<?php

namespace ER\BilleterieBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Description of visitDays
 *Class VisitDays
 * @author eric
 * @package ER\BilleterieBundle\Validator
 * @Annotation
 */
class VisitDays extends Constraint {
    public $message = "La date séléctionné est passé, veuillez séléctionner une date valide.";
    public $message2 = "désolé, nous sommes fermé les dimanches et mardis";
    public $message3= "désolé nous serons fermé à cette date";
    public $message4 = "Il est plus de 14h, veuillez séléctionner un billet demi-journée";
    public $message5 = "Le musée est complet à cette date";
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}
