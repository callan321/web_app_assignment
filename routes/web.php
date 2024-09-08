<?php

use App\Services\DatabaseService;
use Illuminate\Support\Facades\Route;

Route::get('/', function (DatabaseService $db) {
    // Fetch items from the database
    $items = $db->select('SELECT * FROM items');


    return view('home', ['items' => $items]);
});

// Route for displaying an individual item and its reviews
Route::get('/item/{id}', function ($id, DatabaseService $db) {
    // Fetch the item by its id
    $item = $db->select('SELECT * FROM items WHERE id = ?', [$id]);

    // Fetch reviews for the specific item
    $reviews = $db->select('SELECT * FROM reviews WHERE item_id = ?', [$id]);

    // If no item is found, return a 404 error
    if (empty($item)) {
        abort(404, 'Item not found');
    }

    // Pass the item and its reviews to the view
    return view('item', [
        'item' => $item[0],  // Get the first result since it's a single item
        'reviews' => $reviews
    ]);
});

Route::get('/review', function (DatabaseService $db) {
    return view('review');
});
