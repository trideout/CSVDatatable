<?php
namespace redcat\Datastores;


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
        $this->headers = array_pop(array_reverse($data));
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

    public function addColumn(string $rule): void
    {
        foreach($this->values as $key => $row)
        {
            $actions = explode(' ', $rule);
            $newValue = '';
        }
    }
}