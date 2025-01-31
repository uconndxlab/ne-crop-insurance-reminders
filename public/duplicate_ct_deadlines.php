<?php
// the purpose of this file is to duplicate the deadlines for Connecticut for all the other states

require_once 'functions.php';

$connecticut_deadlines_stmt = $db->query('SELECT * FROM crops_states_deadlines WHERE state_id = 1');
$connecticut_deadlines = [];
while ($row = $connecticut_deadlines_stmt->fetchArray(SQLITE3_ASSOC)) {
    $connecticut_deadlines[] = $row;
}

$states_stmt = $db->query('SELECT * FROM states');
$states = [];
while ($row = $states_stmt->fetchArray(SQLITE3_ASSOC)) {
    $states[] = $row;
}

foreach ($states as $state) {
    if ($state['id'] == 1) {
        continue;
    }

    foreach ($connecticut_deadlines as $deadline) {
        $db->exec('INSERT INTO crops_states_deadlines (crop_id, state_id, deadline_name, deadline) VALUES (' . $deadline['crop_id'] . ', ' . $state['id'] . ', "' . $deadline['deadline_name'] . '", "' . $deadline['deadline'] . '")');
    }
}
