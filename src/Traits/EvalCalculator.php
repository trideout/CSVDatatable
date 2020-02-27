<?php
namespace redcat\Traits;


use redcat\Exceptions\ValidationException;

trait EvalCalculator
{
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
            if (isset($headerKeys[$component])) {
                if (!is_numeric($row[$headerKeys[$component]])) {
                    $output .= '"' . $row[$headerKeys[$component]] . '"';
                } else {
                    $output .= $row[$headerKeys[$component]];
                }
                continue;
            }
            $output .= $component;
        }
        $output .= ';';
        try {
            $output = preg_replace('/([0-9\.]+[\\+\\-\\*\\/]{1}[0-9\.][\\+\\-\\*\\/]{1}[0-9]+)/', '( $1 )', $output);
            return (string)eval($output);
        } catch (\Exception $e) {
            throw new ValidationException('Unable to process new column. Please verify that the rule is in the correct format.');
        }
    }
}