<?php

include_once '../vendor/autoload.php';
define('ROOT_PATH', dirname(__DIR__));
session_start();
$router = new \redcat\Controllers\BaseController();
try {
    if (count($_FILES)) {
        $router->uploadCsv($_FILES['csvFile']['tmp_name']);
    }
    if (!isset($_SESSION['spreadsheet'])) {
        $router->drawForm();
        exit();
    }

    switch ($_REQUEST['action']??'') {
        case 'addColumn':
            //TODO: request sanitization and handler
            $router->addColumn($_REQUEST['name'], $_REQUEST['rule']);
            break;
        case 'deleteColumn':
            //TODO: future functionality
            break;
        case 'uploadCsv':
            //TODO: upload handler
            $router->uploadCsv($_FILES['csvFile']['tmp_name']);
            break;
        case 'restart':
            //TODO: extended user and user-input handler
            $router->restart();
            break;
        default:
            $router->drawDatatable();
    }
}catch(Exception $e){
    $_SESSION['errors'] = 'An unknown error has occured: ' . $e->getMessage();
    $router->restart();
}