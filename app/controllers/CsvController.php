<?php
namespace App\Controllers;

use Config\Database;
use App\Models\CsvModel;
use League\Csv\Exception as CsvException;
use PDOException;

class CsvController {
    private $csvModel;
    private $file;

    public function __construct() {
        if(isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK){
            $this->file = $_FILES['csv_file']['tmp_name'];
            
        } else {
            $this->file = false;  
        }
        $database = new Database();
        $db = $database->connect();
        $this->csvModel = new CsvModel($db);
    }

    public function updateDB() {
        try {
            $this->csvModel->updateWithCsv($this->file);
            header("Location: /php_csv_managment/");
        } catch (CsvException $e) {
            echo "Error reading CSV: " . $e->getMessage();
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }

    public function exportCsv() {
        try {
            $this->csvModel->exportCSV();
            //header("Location: /php_csv_managment/");
        } catch (CsvException $e) {
            echo "Error reading CSV: " . $e->getMessage();
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    }
}