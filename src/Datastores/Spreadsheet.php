<?php
namespace redcat\Datastores;


use redcat\Exceptions\ValidationException;
use redcat\Factories\Validator;
use redcat\Validators\HeaderValidator;

class Spreadsheet
{
    /**
     * @var array
     */
    private $values;
    /**
     * @var mixed
     */
    private $headers;

    public function __construct(array $data)
    {
        $headerData = array_reverse($data);
        $this->headers = array_pop($headerData);
        $this->headers = array_map(function($value){
            return strtolower(
                str_replace(' ','_',
                    trim($value)
                )
            );
        }, $this->headers);
        $validator = new Validator($this);
        $validator->validate(HeaderValidator::class, $this->headers);
        unset($data[0]);
        $this->values = array_values($data);
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public function addColumn($name, $values): void
    {
        $this->headers[] = $name;
        $i=0;
        foreach ($this->values as &$row){
            $row[] = $values[$i];
            $i++;
        }
    }

    public function has(string $string): bool
    {
        if (isset($this->headers[$string])) {
            return true;
        }
        return false;
    }
}