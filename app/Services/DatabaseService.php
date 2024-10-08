<?php

namespace App\Services;

use PDO;
use PDOException;

class DatabaseService
{
    private $pdo;

    // Constructor to initiate the connection
    public function __construct()
    {
        $this->connect();
    }

    // Method to handle database connection
    private function connect(): void
    {
        $dbPath = database_path('database.sqlite');

        try {
            $this->pdo = new PDO('sqlite:' . $dbPath);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    // Method for selecting data
    public function select($query, $params = [])
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Insert data into the database
    public function insert($query, $params = [])
    {
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($params);
    }

    // Update data in the database
    public function update($query, $params = [])
    {
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($params);
    }

    // Delete data from the database
    public function delete($query, $params = [])
    {
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($params);

    }
}
