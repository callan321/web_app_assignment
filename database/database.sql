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

INSERT INTO items (name, manufacturer) VALUES ('Phone X', 'Brand A');
INSERT INTO items (name, manufacturer) VALUES ('Phone Y', 'Brand B');

INSERT INTO reviews (item_id, user_name, rating, review_text) VALUES (1, 'Alice', 5, 'Great phone!');
INSERT INTO reviews (item_id, user_name, rating, review_text) VALUES (1, 'Bob', 4, 'Good performance.');
