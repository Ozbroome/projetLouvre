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
    public $message = "Le jour séléctionné vous oblige à remonter le temps.";
    public $message2 = "désolé, nous sommes fermé les dimanches et mardis";
    public $message3= "désolé nous serons fermé sur cette période";
    public $message4 = "Nous n'allons quand même pas vous faire payer une journée entière";
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}
