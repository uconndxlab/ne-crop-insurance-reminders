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

function get_logged_in_user() {
    global $db;
    $user_id = $_SESSION['user_id'];
    $results = $db->query('SELECT * FROM users WHERE id = ' . $user_id);
    $row = $results->fetchArray();
    return $row;
}