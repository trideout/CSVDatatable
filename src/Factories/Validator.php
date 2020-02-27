<?php
namespace redcat\Factories;

class Validator
{
    private $spreadsheet;

    public function __construct($spreadsheet)
    {
        $this->spreadsheet = $spreadsheet;
    }

    public function validate(string $type, $data): bool
    {
        $validator = new $type($data, $this->spreadsheet);
        return $validator->validate();
    }
}