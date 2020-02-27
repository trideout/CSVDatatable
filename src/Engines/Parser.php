<?php
namespace redcat\Engines;

use redcat\Datastores\Spreadsheet;
use redcat\Exceptions\ValidationException;
use redcat\Factories\Validator;
use redcat\Validators\FormulaValidator;

class Parser
{
    private $spreadsheet;
    private $rule;
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name, string $rule, Spreadsheet $spreadsheet)
    {
        $this->name = $name;
        $this->rule = $rule;
        $this->spreadsheet = $spreadsheet;
    }

    public function parse(): void
    {
        preg_match_all('/(\w+)|("(?:[^"])*")|(\/|\+|\-|\*|\&|\(|\))/', $this->rule, $components);
        $validator = new Validator($this->spreadsheet);
        $validator->validate(FormulaValidator::class, [
            'name' => $this->name,
            'rule' => $this->rule,
            'components' => $components
        ]);
        $components = $components[0];
        $column = [];
        foreach($this->spreadsheet->getValues() as $id => $row)
        {
            $column[] = $this->calculateRow($components, $row);
        }
        $this->spreadsheet->addColumn($this->name, $column);
    }

    public function calculateRow($components, $row)
    {
        $output = 'return ';
        $headerKeys = array_flip($this->spreadsheet->getHeaders());
        foreach ($components as $component) {
            if (in_array($component, ['+', '-', '/', '*', '(', ')'])) {
                $output .= $component;
                continue;
            }
            if ($component === '&') {
                $output .= ' . ';
                continue;
            }
            if(isset($headerKeys[$component])){
                if(!is_numeric($row[$headerKeys[$component]])){
                    $output .= '"' . $row[$headerKeys[$component]] . '"';
                }else {
                    $output .= $row[$headerKeys[$component]];
                }
                continue;
            }
            $output .= $component;
        }
        $output .= ';';
        try {
            return (string)eval($output);
        }catch(\Exception $e){
            throw new ValidationException('Unable to process new column. Please verify that the rule is in the correct format.');
        }
    }
}