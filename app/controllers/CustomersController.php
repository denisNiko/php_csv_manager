<?php
namespace App\Controllers;

use Config\Database;
use App\Models\Customers;

class CustomersController {
    private $customer;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->customer = new Customers($db);
    }

    public function index(){
        return $this->customer->getAll();
    }
}