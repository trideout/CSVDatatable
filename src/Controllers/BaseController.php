<?php
namespace redcat\Controllers;

use redcat\Datastores\Spreadsheet;
use redcat\Engines\CsvParser;
use redcat\Engines\View;

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
        $_SESSION['spreadsheet'] = new Spreadsheet((new CsvParser($filename))->asArray());
        $this->view->redirectBack();
    }

    public function drawDatatable(): void
    {
        $this->view->render('datatable');
    }

    public function addColumn(string $columnDefinition): void
    {

    }

    public function restart(): void
    {
        unset($_SESSION['spreadsheet']);
        $this->view->redirectBack();
    }
}