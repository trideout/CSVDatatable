<?php


namespace redcat\Validators;


use redcat\Contracts\Validation;

class FormulaValidator extends Validation
{

    private $formula;

    public function __construct($data)
    {
        $this->formula = $data;
    }

    public function validate(): bool
    {
        // TODO: Implement validate() method.
        if (/**regexmatch**/ true) {
            throw new \Exception('this is an error');
        }
        return true;
    }
}