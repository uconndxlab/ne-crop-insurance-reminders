<?php

$db = SQLite3('db.sqlite');

/** trying this as row-based instead of with firestore */

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

/** create crops_states */
$db->exec('CREATE TABLE IF NOT EXISTS crops_states (
    id INTEGER PRIMARY KEY,
    crop_id INTEGER NOT NULL,
    state_id INTEGER NOT NULL,
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
    deadline DATETIME NOT NULL,
    reminder DATETIME NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)');

