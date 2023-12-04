<?php

$db = new SQLite3('../db.sqlite');

function do_register() {
    global $db;
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    if ($password !== $password_confirm) {
        $_SESSION['error'] = 'Passwords do not match';
        header('Location: /');
        exit;
    }

    if (user_exists($email)) {
        $_SESSION['error'] = 'User already exists';
        header('Location: /');
        exit;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";
   
    $db->exec($sql);
    $_SESSION['user_id'] = $db->lastInsertRowID();
    $_SESSION['firstname'] = $firstname;
    $_SESSION['success'] = 'You are now registered and logged in as ' . $email;
    header('Location: /profile');
    exit;
}

function user_exists($email) {
    global $db;
    $results = $db->query("SELECT * FROM users WHERE email = '$email'");
    $row = $results->fetchArray();
    if ($row) {
        return true;
    }
    return false;
}

function do_login() {
    global $db;
    $email = $_POST['email'];
    $password = $_POST['password'];  
    $results = $db->query("SELECT * FROM users WHERE email = '$email'");
    $row = $results->fetchArray();
    if (password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['success'] = 'You are now logged in as ' . $row['email'];
        header('Location: /profile');
        exit;
    } else {
        $_SESSION['error'] = 'Invalid email or password';
        header('Location: /');
        exit;
    }
}

function save_profile() {
    global $db;
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['new_password'];
    $password_confirm = $_POST['password_confirm'];
    if ($password !== $password_confirm) {
        $_SESSION['error'] = 'Passwords do not match';
        header('Location: /profile');
        exit;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email', phone = '$phone', password = '$password' WHERE id = " . $_SESSION['user_id'];
    $db->exec($sql);
    $_SESSION['success'] = 'Profile updated successfully';
    header('Location: /profile');
    exit;
}

function do_logout() {
    session_destroy();
    header('Location: /');
    exit;
}

function do_layout($file) {
    require_once 'layouts/header.php';
    require_once  $file . '.php';
    require_once 'layouts/footer.php';
}

function get_all_users() {
    global $db;
    $results = $db->query('SELECT * FROM users');
    $users = [];
    while ($row = $results->fetchArray()) {
        $users[] = $row;
    }
    return $users;
}

function get_all_crops() {
    global $db;
    $results = $db->query('SELECT * FROM crops');
    $crops = [];
    while ($row = $results->fetchArray()) {
        $crops[] = $row;
    }
    return $crops;
}

function get_all_states() {
    global $db;
    $results = $db->query('SELECT * FROM states');
    $states = [];
    while ($row = $results->fetchArray()) {
        $states[] = $row;
    }
    return $states;
}

function get_state_name($id) {
    global $db;
    $results = $db->query('SELECT * FROM states WHERE id = ' . $id);
    $row = $results->fetchArray();
    return $row['state'];
}

function get_crop_name($id) {
    global $db;
    $results = $db->query('SELECT * FROM crops WHERE id = ' . $id);
    $row = $results->fetchArray();
    return $row['crop'];
}

function get_deadline($id) {
    global $db;
    $results = $db->query('SELECT * FROM crops_states_deadlines WHERE id = ' . $id);
    $row = $results->fetchArray();
    return $row;
}

function get_all_deadlines() {
    global $db;
    $results = $db->query('SELECT * FROM crops_states_deadlines');
    $deadlines = [];
    while ($row = $results->fetchArray()) {
        $row['state'] = get_state_name($row['state_id']);
        $row['crop'] = get_crop_name($row['crop_id']);
        $deadlines[] = $row;
    }
    return $deadlines;
}

function get_all_reminders() {
    global $db;
    $sql = 'SELECT * FROM deadlines_reminders';
    // left join on deadlines table and crop and state so we can have the name of the deadline, crop, and state
    $sql = 'SELECT deadlines_reminders.id, deadlines_reminders.deadline_id, deadlines_reminders.reminder_send_time, crops_states_deadlines.deadline_name, crops_states_deadlines.deadline, crops_states_deadlines.state_id, crops_states_deadlines.crop_id, states.state, crops.crop FROM deadlines_reminders LEFT JOIN crops_states_deadlines ON deadlines_reminders.deadline_id = crops_states_deadlines.id LEFT JOIN states ON crops_states_deadlines.state_id = states.id LEFT JOIN crops ON crops_states_deadlines.crop_id = crops.id';
    $results = $db->query($sql);
    $reminders = [];
    while ($row = $results->fetchArray()) {
        $row['deadline_id'] = get_deadline($row['deadline_id'])['deadline_name'];
        $row['reminder_send_time'] = $row['reminder_send_time'];
        $row['deadline_name'] = $row['deadline_name'];
        $row['deadline'] = $row['deadline'];
        $row['state'] = $row['state'];


        $reminders[] = $row;
    }
    return $reminders;
}

function get_logged_in_user() {
    global $db;
    $user_id = $_SESSION['user_id'];
    $results = $db->query('SELECT * FROM users WHERE id = ' . $user_id);
    $row = $results->fetchArray();
    return $row;
}