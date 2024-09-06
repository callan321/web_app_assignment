<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Path to your SQLite database
    $dbPath = database_path('database.sqlite');

    // Create a new PDO connection to the SQLite database
    try {
        $pdo = new PDO('sqlite:' . $dbPath);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch items
        $itemsStmt = $pdo->query('SELECT * FROM items');
        $items = $itemsStmt->fetchAll(PDO::FETCH_OBJ);

        // Fetch reviews
        $reviewsStmt = $pdo->query('SELECT * FROM reviews');
        $reviews = $reviewsStmt->fetchAll(PDO::FETCH_OBJ);

    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }

    // Pass the data to the view
    return view('welcome', ['items' => $items, 'reviews' => $reviews]);
});
