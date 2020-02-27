<?php


namespace redcat\Validators;


use redcat\Contracts\Validation;
use redcat\Datastores\Spreadsheet;
use redcat\Exceptions\ValidationException;

class FormulaValidator
{

    private $formula;
    /**
     * @var string
     */
    private $components;
    /**
     * @var string
     */
    private $ruleName;
    private $spreadsheet;

    public function __construct($data,Spreadsheet $spreadsheet)
    {
        $this->ruleName = $data['name'];
        $this->formula = $data['rule'];
        $this->components = $data['components'];
        $this->spreadsheet = $spreadsheet;
    }

    public function validate(): bool
    {
        if(!preg_match('/^[a-zA-Z_0-9].*$/', $this->ruleName)){
            throw new ValidationException('New column names may only include letters, numbers and underscores');
        }
        if(in_array($this->ruleName, $this->spreadsheet->getHeaders())){
            throw new ValidationException('Column name already exists');
        }
        foreach($this->components[1] as $columnName)
        {
            if($columnName && !in_array($columnName, $this->spreadsheet->getHeaders())){
                throw new ValidationException('Unknown Column: ' . $columnName);
            }
        }
        foreach($this->components[3] as $key => $operator) {
            if(in_array($operator, ['-', '+', '*', '/']))
            {
                if(!isset($this->components[3][$key + 1]) || in_array($this->components[3][$key+1], ['-','+','*','/']))
                {
                    throw new ValidationException('New columns must be in the format "variable operator variable"');
                }
                if(!isset($this->components[1][$key - 1]) || !isset($this->components[1][$key + 1]) || !$this->components[1][$key - 1] || !$this->components[1][$key + 1]) {
                    throw new ValidationException('Math operations can only be performed on columns');
                }
            }
        }
        return true;
    }
}