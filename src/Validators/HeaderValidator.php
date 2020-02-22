<?php
namespace redcat\Validators;


use redcat\Contracts\Validation;

class HeaderValidator extends Validation
{
    public function __construct($headers)
    {
        $this->headers = $headers;
    }

    public function validate(): bool
    {
        // TODO: Implement validate() method.
    }
}