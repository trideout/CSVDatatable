<?php
namespace redcat\Controllers;

use redcat\Datastores\Spreadsheet;
use redcat\Engines\CsvParser;
use redcat\Engines\Parser;
use redcat\Engines\View;
use redcat\Exceptions\ValidationException;

class BaseController {
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function drawForm(): void
    {
        $this->view->render('form');
    }

    public function uploadCsv(string $filename): void
    {
        try {
            $_SESSION['spreadsheet'] = new Spreadsheet((new CsvParser($filename))->asArray());
        }catch(ValidationException $e)
        {
            unset($_SESSION['spreadsheet']);
            $_SESSION['errors'] = $e->getMessage();
        }
        $this->view->redirectBack();
    }

    public function drawDatatable(): void
    {
        $this->view->render('datatable');
    }

    public function addColumn(string $name, string $rule): void
    {
        try {
            $parser = new Parser($name, $rule, $_SESSION['spreadsheet']);
            $parser->parse();
            $this->view->redirectBack();
        }catch(ValidationException $e)
        {
            $_SESSION['errors'] = $e->getMessage();
            $this->view->redirectBack();
        }
    }

    public function restart(): void
    {
        unset($_SESSION['spreadsheet']);
        $this->view->redirectBack();
    }
}