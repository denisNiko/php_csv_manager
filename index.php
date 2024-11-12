<?php
require_once 'vendor/autoload.php';

use App\Controllers\CsvController;
use App\Controllers\CustomersController;

$action = $_GET['action'] ?? '';
$csvController;
$customersController = new CustomersController();

switch($action) {
    case 'upload': 
        $csvController = new CsvController();
        $csvController->updateDB();
        break;
    case 'export':
        $csvController = new CsvController();
        $csvController->exportCsv(); 
        break;
    default: 
        $customers = $customersController->index();
        require 'app/views/default/header.php';
        require 'app/views/index.php';
        require 'app/views/default/footer.php';
        break;
}