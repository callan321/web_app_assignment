<?php

use App\Services\DatabaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('home');
});

Route::get('/home/{type?}', function (DatabaseService $db, $type = '') {
    $query = '';

    // Determine which query to use based on the {type} parameter
    if ($type === 'revasc') {
        $query = "
            SELECT *,
                   (SELECT COUNT(*) FROM reviews r WHERE r.item_id = items.id) AS review_count,
                   (SELECT IFNULL(AVG(rating), 0) FROM reviews r WHERE r.item_id = items.id) AS average_rating
            FROM items
            ORDER BY review_count ASC
        ";
    } elseif ($type === 'revdesc') {
        $query = "
            SELECT *,
                   (SELECT COUNT(*) FROM reviews r WHERE r.item_id = items.id) AS review_count,
                   (SELECT IFNULL(AVG(rating), 0) FROM reviews r WHERE r.item_id = items.id) AS average_rating
            FROM items
            ORDER BY review_count DESC
        ";
    } elseif ($type === 'rateasc') {
        $query = "
            SELECT *,
                   (SELECT COUNT(*) FROM reviews r WHERE r.item_id = items.id) AS review_count,
                   (SELECT IFNULL(AVG(rating), 0) FROM reviews r WHERE r.item_id = items.id) AS average_rating
            FROM items
            ORDER BY average_rating ASC
        ";
    } elseif ($type === 'ratedesc') {
        $query = "
            SELECT *,
                   (SELECT COUNT(*) FROM reviews r WHERE r.item_id = items.id) AS review_count,
                   (SELECT IFNULL(AVG(rating), 0) FROM reviews r WHERE r.item_id = items.id) AS average_rating
            FROM items
            ORDER BY average_rating DESC
        ";
    } else {
        // Default sorting by created_at
        $query = "
            SELECT *,
                   (SELECT COUNT(*) FROM reviews r WHERE r.item_id = items.id) AS review_count,
                   (SELECT IFNULL(AVG(rating), 0) FROM reviews r WHERE r.item_id = items.id) AS average_rating
            FROM items
        ";
    }

    // Execute the query and return with sorted items
    $items = $db->select($query);
    return view('home', ['items' => $items]);
});


Route::get('/item/del/{id}', function (DatabaseService $db, int $id) {
    // delete reviews first then item
    $db->delete("DELETE FROM reviews WHERE item_id = ?", [$id]);
    $db->delete("DELETE FROM items WHERE id = ?", [$id]);
    return redirect('/');
});

Route::get('/item/{id}', function ($id, DatabaseService $db) {
    // Fetch the item by its id along with review count and average rating
    $query = "
        SELECT *,
               (SELECT COUNT(*) FROM reviews r WHERE r.item_id = items.id) AS review_count,
               (SELECT IFNULL(AVG(r.rating), 0) FROM reviews r WHERE r.item_id = items.id) AS average_rating
        FROM items
        WHERE items.id = ?
    ";

    // Execute the query to get the item with review data
    $item = $db->select($query, [$id]);

    // Fetch reviews for the specific item
    $reviews = $db->select('SELECT * FROM reviews WHERE item_id = ?', [$id]);

    // If no item is found, show a 404
    if (empty($item)) {
        abort(404, 'Item not found');
    }

    // Return the view with the item, reviews, review count, and average rating
    return view('item', [
        'item' => $item[0],
        'reviews' => $reviews,
        'review_count' => $item[0]->review_count,
        'average_rating' => $item[0]->average_rating
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

Route::post('/post-review', function (Request $request, DatabaseService $db) {
    // Form Data
    $userName = session('username', $request->input('user_name'));
    $rating = $request->input('rating');
    $reviewText = $request->input('review_text');
    $itemId = $request->input('item_id');

    // Sanitize and validate
    $forbiddenChars = ['-', '_', '+', '"'];
    foreach ($forbiddenChars as $char) {
        if (str_contains($userName, $char)) {
            die("Error: Invalid name. Name cannot have: - _ + \"");
        }
    }

    if (strlen($userName) < 3) {
        die("Error: Username must be at least 3 characters long.");
    }

    // Remove odd numbers from username
    $originalUserName = $userName;
    $oddNumbers = ['1', '3', '5', '7', '9'];
    foreach ($oddNumbers as $odd) {
        $userName = str_replace($odd, '', $userName);
    }

    // If the username has changed, redirect
    if ($userName !== $originalUserName) {
        return redirect("/item/$itemId?name_changed=$userName");
    }
    session(['username' => $userName]);

    // Insert the new review
    $db->insert('INSERT INTO reviews (user_name, rating, review_text, item_id) VALUES (?, ?, ?, ?)',
        [$userName, $rating, $reviewText, $itemId]);

    return redirect("/item/$itemId");
});

Route::post('/update-review', function (Request $request, DatabaseService $db) {
    // Form Data
    $userName = $request->input('user_name');
    $rating = $request->input('rating');
    $reviewText = $request->input('review_text');
    $itemId = $request->input('item_id');
    $reviewId = $request->input('review_id');

    // Sanitize and validate
    $forbiddenChars = ['-', '_', '+', '"'];
    foreach ($forbiddenChars as $char) {
        if (str_contains($userName, $char)) {
            die("Error: Invalid name. Name cannot have: - _ + \"");
        }
    }

    if (strlen($userName) < 3) {
        die("Error: Username must be at least 3 characters long.");
    }

    // Remove odd numbers from username
    $originalUserName = $userName;
    $oddNumbers = ['1', '3', '5', '7', '9'];
    foreach ($oddNumbers as $odd) {
        $userName = str_replace($odd, '', $userName);
    }

    // If the username has changed, redirect
    if ($userName !== $originalUserName) {
        return redirect("/item/$itemId?name_changed=$userName");
    }

    // Update the review
    $db->update('UPDATE reviews SET user_name = ?, rating = ?, review_text = ?, item_id = ? WHERE id = ?',
        [$userName, $rating, $reviewText, $itemId, $reviewId]);

    return redirect("/item/$itemId");
});

Route::get('/manufacturers', function (DatabaseService $db) {
    // manufacturers and average item rating
    $query = "
        SELECT manufacturer,
               IFNULL(AVG(
                   (SELECT AVG(rating)
                    FROM reviews
                    WHERE reviews.item_id = items.id)
               ), 0) AS average_rating
        FROM items
        GROUP BY manufacturer
        ORDER BY average_rating DESC
    ";

    $manufacturers = $db->select($query);
    return view('manufacturers', ['manufacturers' => $manufacturers]);
});

Route::get('/manufacturer/{manufacturer}', function (DatabaseService $db, $manufacturer) {
    // Decode the manufacturer name to handle spaces properly
    $manufacturer = urldecode($manufacturer);

    // items of manufacturer and average rating
    $query = "
        SELECT items.*,
               IFNULL(
                   (SELECT AVG(rating)
                    FROM reviews
                    WHERE reviews.item_id = items.id), 0) AS average_rating
        FROM items
        WHERE manufacturer = ?
        ORDER BY average_rating DESC
    ";

    $items = $db->select($query, [$manufacturer]);
    return view('manufacturer_items', ['manufacturer' => $manufacturer, 'items' => $items]);
});
