<?php

$db = new SQLite3('db.sqlite');

/** remove all tables to start over */
$db->exec('DROP TABLE IF EXISTS users');
$db->exec('DROP TABLE IF EXISTS user_crops');
$db->exec('DROP TABLE IF EXISTS states');
$db->exec('DROP TABLE IF EXISTS crops');
$db->exec('DROP TABLE IF EXISTS crops_states');
$db->exec('DROP TABLE IF EXISTS crops_states_deadlines');
$db->exec('DROP TABLE IF EXISTS deadlines_reminders');


/** create a users table assuming firebase IDs */
$db->exec('CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY,
    firebase_id TEXT NOT NULL,
    state_id INTEGER NOT NULL,
    email TEXT NOT NULL,
    phone TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)');

/** create user_crops table */
$db->exec('CREATE TABLE IF NOT EXISTS user_crops (
    id INTEGER PRIMARY KEY,
    user_id INTEGER NOT NULL,
    crop_id INTEGER NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)');

/** create states table */
$db->exec('CREATE TABLE IF NOT EXISTS states (
    id INTEGER PRIMARY KEY,
    state TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)');

/** create crops table */
$db->exec('CREATE TABLE IF NOT EXISTS crops (
    id INTEGER PRIMARY KEY,
    crop TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)');

/** create crops_states_deadlines table */
$db->exec('CREATE TABLE IF NOT EXISTS crops_states_deadlines (
    id INTEGER PRIMARY KEY,
    crop_id INTEGER NOT NULL,
    state_id INTEGER NOT NULL,
    deadline_name TEXT NOT NULL,
    deadline DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)');

/** create deadlines_reminders table */
$db->exec('CREATE TABLE IF NOT EXISTS deadlines_reminders (
    id INTEGER PRIMARY KEY,
    crop_id INTEGER NOT NULL,
    state_id INTEGER NOT NULL,
    deadline_id INTEGER NOT NULL,
    reminder_time DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)');

/** insert states (new england) */
$db->exec('INSERT INTO states (state) VALUES ("Connecticut")');
$db->exec('INSERT INTO states (state) VALUES ("Maine")');
$db->exec('INSERT INTO states (state) VALUES ("Massachusetts")');
$db->exec('INSERT INTO states (state) VALUES ("New Hampshire")');
$db->exec('INSERT INTO states (state) VALUES ("Rhode Island")');
$db->exec('INSERT INTO states (state) VALUES ("Vermont")');

/** insert crops */

$crops = [
    "Apiculture",
    "Apples",
    "Barley",
    "Blueberries-Lowbush",
    "Clams",
    "Controlled Environment",
    "Corn",
    "Cranberries",
    "Dairy Revenue Prot.",
    "Forage-Production",
    "Forage Seeding",
    "FM Sweet Corn",
    "FM Tomatoes",
    "Grapes",
    "Livestock Gross Margin",
    "Livestock Risk Protection",
    "Micro Farm - Early Filer",
    "Micro Farm - Late Filer",
    "Nursery(Field Gr.& Cont.)",
    "Pasture Rangeland Forage",
    "Peaches",
    "Potatoes",
    "Oysters (Shellfish)",
    "Soybeans",
    "Tobacco - Cigar Binder",
    "Tobacco - Cigar Wrapper",
    "Whole Farm Rev Prot.-Early Filer",
    "Whole Farm Rev Prot.-Late Filer",
    "Wheat"
];

foreach ($crops as $crop) {
    $db->exec('INSERT INTO crops (crop) VALUES ("' . $crop . '")');
}


/** insert crops_states_deadlines */
/** apiculture, ct, sales_closing: 12/1/2023 */
/** apiculture, ct, acreage_reporting: 12/1/2023 */
/** apiculture, ct, production_reporting: 12/1/2023 */

$db->exec('INSERT INTO crops_states_deadlines (crop_id, state_id, deadline_name, deadline) VALUES (1, 1, "sales_closing", "2023-12-01")');
$db->exec('INSERT INTO crops_states_deadlines (crop_id, state_id, deadline_name, deadline) VALUES (1, 1, "acreage_reporting", "2023-12-01")');
$db->exec('INSERT INTO crops_states_deadlines (crop_id, state_id, deadline_name, deadline) VALUES (1, 1, "production_reporting", "2023-12-01")');