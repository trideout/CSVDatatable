<?php
namespace redcat\Validators;

use redcat\Exceptions\ValidationException;
use redcat\Contracts\Validation;

class HeaderValidator
{
    private $spreadsheet;

    public function __construct($headers, $spreadsheet = null)
    {
        $this->headers = $headers;
    }

    public function validate(): bool
    {
        foreach($this->headers as $header)
        {
            if(!preg_match('/^[a-zA-Z_]*$/', $header))
            {
                throw new ValidationException('Only letters and underscores may be used in the header row');
            }
        }
        return true;
    }
}