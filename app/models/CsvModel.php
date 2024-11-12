<?php
namespace App\Models;

use League\Csv\Reader;
use League\Csv\Writer;
use PDO;
use SplTempFileObject;

class CsvModel {
    private $conn;
    public function __construct($db) {
        $this->conn = $db;
    }

    public function updateWithCsv($filePath) {

        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);

        $updateQuery = "UPDATE customers SET 
        first_name = :first_name, 
        last_name = :last_name,
        company = :company, 
        city = :city, 
        country = :country, 
        phone_1 = :phone_1, 
        phone_2 = :phone_2, 
        email = :email, 
        subscription_date = STR_TO_DATE(:subscription_date, '%m/%d/%Y'), 
        website = :website
        WHERE customer_id = :customer_id";

        $insertQuery = "INSERT INTO customers (customer_id, first_name, last_name, company, city, country, phone_1, phone_2, email, subscription_date, website) VALUES (:customer_id, :first_name, :last_name, :company, :city, :country, :phone_1, :phone_2, :email, STR_TO_DATE(:subscription_date, '%m/%d/%Y'), :website)";

        $updateStmn = $this->conn->prepare($updateQuery);
        $insertStmn = $this->conn->prepare($insertQuery);

        $csvRecords = iterator_to_array($csv->getRecords());

        foreach($csvRecords as $row) {
            $customer_id = $row['Customer Id']; 

            $checkStmt = $this->conn->prepare("SELECT COUNT(*) FROM customers WHERE customer_id = :customer_id");
            $checkStmt->execute(['customer_id' => $customer_id]);
            $exists = $checkStmt->fetchColumn();

            if($exists > 0) {
                $updateStmn->execute([
                    'first_name' => $row['First Name'],
                    'last_name' => $row['Last Name'],
                    'company' => $row['Company'],
                    'city' => $row['City'],
                    'country' => $row['Country'],
                    'phone_1' => $row['Phone 1'],
                    'phone_2' => $row['Phone 2'],
                    'email' => $row['Email'],
                    'subscription_date' => $row['Subscription Date'],
                    'website' => $row['Website'],
                    'customer_id' => $customer_id
                ]);
            } else {
                $insertStmn->execute([
                    'customer_id' => $customer_id,
                    'first_name' => $row['First Name'],
                    'last_name' => $row['Last Name'],
                    'company' => $row['Company'],
                    'city' => $row['City'],
                    'country' => $row['Country'],
                    'phone_1' => $row['Phone 1'],
                    'phone_2' => $row['Phone 2'],
                    'email' => $row['Email'],
                    'subscription_date' => $row['Subscription Date'],
                    'website' => $row['Website']
                ]);
            }
        }
    }

    public function exportCSV(){
        $filename = $_POST['filename'];
        $limit = isset($_POST['limit']) && $_POST['limit'] !== '' ? (int)$_POST['limit'] : null;
        $offset = isset($_POST['offset']) && $_POST['offset'] !== '' ? (int)$_POST['offset'] : 0;

        if(pathinfo($filename, PATHINFO_EXTENSION) !== '.csv') {
            $filename .= '.csv';
        }

        $query = "SELECT * FROM customers";
        if($limit !== null) {
            $query .= " LIMIT :limit";
            if($offset > 0) {
                $query .= " OFFSET :offset";
            }
        } elseif($offset > 0) {
            $query .= " OFFSET :offset";
        }

        $stmn = $this->conn->prepare($query);

        if($limit !== null) {
            $stmn->bindParam(':limit', $limit, PDO::PARAM_INT);
        }

        if($offset > 0) {
            $stmn->bindParam(':offset', $offset, PDO::PARAM_INT);
        }

        $stmn->execute();
        $result = $stmn->fetchAll(PDO::FETCH_ASSOC);
        
        $csvExport = Writer::createFromFileObject(new SplTempFileObject());
        $csvExport->insertOne(['ID', 'Customer Id', 'First Name', 'Last Name', 'Company', 'City', 'Country', 'Phone 1', 'Phone 2', 'Email', 'Subscription Date', 'Website']);
        // if(!empty($result)) {
        //     $csvExport->insertOne(array_keys($result[0]));
        // }
        foreach($result as $row){
            $csvExport->insertOne($row);
        }

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Output CSV directly to the response
        echo $csvExport->toString();
        exit;
    }
}