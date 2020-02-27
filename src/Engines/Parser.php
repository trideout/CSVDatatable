<?php
namespace redcat\Engines;

use redcat\Datastores\Spreadsheet;
use redcat\Exceptions\ValidationException;
use redcat\Factories\Validator;
use redcat\Traits\EvalCalculator;
use redcat\Validators\FormulaValidator;

class Parser
{
    use EvalCalculator;

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
}