<?php

namespace App\Models;

use PDO;

class Customers {
    private $conn;
    private $table = 'customers';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll(){
        $query = "SELECT * FROM " . $this->table;
        $stmn = $this->conn->prepare($query);
        $stmn->execute();

        return $stmn->fetchAll(PDO::FETCH_ASSOC);
    }
}