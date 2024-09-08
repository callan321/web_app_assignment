<?php

use App\Services\DatabaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (DatabaseService $db) {
    // Fetch items from the database
    $items = $db->select('SELECT * FROM items');


    return view('home', ['items' => $items]);
});


Route::get('/item/del/{id}', function (DatabaseService $db, int $id) {
    // delete reviews first then item
    $db->delete("DELETE FROM reviews WHERE item_id = ?", [$id]);
    $db->delete("DELETE FROM items WHERE id = ?", [$id]);
    return redirect('/');
});

Route::get('/item/{id}', function ($id, DatabaseService $db) {
    // Fetch the item by its id
    $item = $db->select('SELECT * FROM items WHERE id = ?', [$id]);
    // Fetch reviews for the specific item
    $reviews = $db->select('SELECT * FROM reviews WHERE item_id = ?', [$id]);
    // If no item is  found show a 404
    if (empty($item)) {
        abort(404, 'Item not found');
    }
    return view('item', [
        'item' => $item[0],
        'reviews' => $reviews
    ]);
});

Route::get('/add-item', function(DatabaseService $db) {
    return view('add_item');
});


Route::post('/add-item', function (Request $request, DatabaseService $db) {
    // Form Data
    $name = $request->input('name');
    $manufacturer = $request->input('manufacturer');

    // validate
    $forbiddenChars = ['-', '_', '+', '"'];
    foreach ($forbiddenChars as $char) {
        if (str_contains($name, $char) || str_contains($manufacturer, $char)) {
            die("Error: Invalid name. Name cannot have: - _ + \"");
        }
    }
    if (strlen($name) < 3 || strlen($manufacturer) < 3) {
        die("Error: Name must be 3 characters long.");
    }

    // Insert Items
    $db->insert('INSERT INTO items (name, manufacturer) VALUES (?, ?)', [$name, $manufacturer]);
    return redirect('/');
});


Route::get('/review/{id}', function (DatabaseService $db, $id) {
    return view('review', ['itemId' => $id]);
});

Route::post('/add-review', function (Request $request, DatabaseService $db) {
    // Form Data
    $userName = $request->input('user_name');
    $rating = $request->input('rating');
    $reviewText = $request->input('review_text');
    $itemId = $request->input('item_id');

    // for sanitization
    $originalUserName = $userName;
    // validate
    $forbiddenChars = ['-', '_', '+', '"'];
    foreach ($forbiddenChars as $char) {
        if (str_contains($userName, $char)) {
            die("Error: Invalid name. Name cannot have: - _ + \"");
        }
    }

    if (strlen($userName) < 3) {
        die("Error: Username must be at least 3 characters long.");
    }

    $oddNumbers = ['1', '3', '5', '7', '9'];
    foreach ($oddNumbers as $odd) {
        $userName = str_replace($odd, '', $userName);
    }
    if ($userName !== $originalUserName) {
        return redirect("/item/$itemId?name_changed=$userName");
    }

    $db->insert('INSERT INTO reviews (user_name, rating, review_text, item_id) VALUES (?, ?, ?, ?)',
        [$userName, $rating, $reviewText, $itemId]);
    return redirect("/item/$itemId");
});
