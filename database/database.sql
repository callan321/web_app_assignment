CREATE TABLE sessions (
    id TEXT PRIMARY KEY,
    user_id INTEGER,
    ip_address TEXT,
    user_agent TEXT,
    payload TEXT NOT NULL,
    last_activity INTEGER
);


CREATE TABLE items (
   id INTEGER PRIMARY KEY AUTOINCREMENT,
   name TEXT NOT NULL,
   manufacturer TEXT NOT NULL,
   created_at TEXT DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reviews (
     id INTEGER PRIMARY KEY AUTOINCREMENT,
     item_id INTEGER,
     user_name TEXT,
     rating INTEGER,
     review_text TEXT,
     created_at TEXT DEFAULT CURRENT_TIMESTAMP,
     FOREIGN KEY (item_id) REFERENCES items(id) ON DELETE CASCADE
);

-- Items
INSERT INTO items (name, manufacturer) VALUES ('Galaxy Phone', 'Samsung');
INSERT INTO items (name, manufacturer) VALUES ('Galaxy Tablet', 'Samsung');
INSERT INTO items (name, manufacturer) VALUES ('Desktop', 'Microsoft');
INSERT INTO items (name, manufacturer) VALUES ('MacBook', 'Apple');

-- Reviews
INSERT INTO reviews (item_id, user_name, rating, review_text) VALUES (1, 'John', 5, 'Excellent phone.');
INSERT INTO reviews (item_id, user_name, rating, review_text) VALUES (2, 'Jane', 4, 'Good size.');
INSERT INTO reviews (item_id, user_name, rating, review_text) VALUES (3, 'Emily', 4, 'Solid pc, good performance.');
INSERT INTO reviews (item_id, user_name, rating, review_text) VALUES (4, 'Chris', 5, 'Fantastic laptop.');
INSERT INTO reviews (item_id, user_name, rating, review_text) VALUES (1, 'Brandon', 1, 'Terrible phone, do not buy!');
INSERT INTO reviews (item_id, user_name, rating, review_text) VALUES (1, 'Kaleb', 3, 'OK.');
