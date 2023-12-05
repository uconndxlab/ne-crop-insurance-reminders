<?php

$db = new SQLite3('../db.sqlite');

function check_session() {

    if(!isset($_SESSION['user_id'])) {
     // if we're on the login page, don't redirect
        if($_SERVER['REQUEST_URI'] === '/login') {
            return;
        }
        $_SESSION['error'] = 'You must be logged in to view that page';
        header('Location: /login');
        exit;
    } else {
        // get the latest user info from the database
        $user = get_logged_in_user();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['lastname'] = $user['lastname'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['phone'] = $user['phone'];
    }
}

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
    $_SESSION['lastname'] = $lastname;
    $_SESSION['email'] = $email;
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
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['phone'] = $row['phone'];


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

function save_profile($user_id=0) {
    global $db;
   
    if($user_id) {
        $sql = "UPDATE users SET firstname = '" . $_POST['firstname'] . "', lastname = '" . $_POST['lastname'] . "', email = '" . $_POST['email'] . "', phone = '" . $_POST['phone'] . "' WHERE id = $user_id";
    } else {
        $sql = "INSERT INTO users (firstname, lastname, email, phone) VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" . $_POST['phone'] . "')";
    }

    if($db->exec($sql)) {
        $_SESSION['success'] = 'Profile saved successfully';
        header('Location: /profile');
        exit;
    } else {
        $_SESSION['error'] = 'Error saving profile';
        header('Location: /profile');
        exit;
    }
}

function save_crop($crop_id = 0) {
    global $db;
    if ($crop_id) {
        $sql = "UPDATE crops SET crop = '" . $_POST['crop'] . "' WHERE id = $crop_id";
    } else {
        $sql = "INSERT INTO crops (crop) VALUES ('" . $_POST['crop'] . "')";
    }

    if($db->exec($sql)) {
        $_SESSION['success'] = 'Crop saved successfully';
        header('Location: /');
        exit;
    } else {
        $_SESSION['error'] = 'Error saving crop';
        header('Location: /');
        exit;
    }
}

function save_state($state_id=0) {
    global $db;
    if($state_id) {
        $sql = "UPDATE states SET state = '" . $_POST['state'] . "' WHERE id = $state_id";
    } else {
        $sql = "INSERT INTO states (state) VALUES ('" . $_POST['state'] . "')";
    }

    if($db->exec($sql)) {
        $_SESSION['success'] = 'State saved successfully';
        header('Location: /');
        exit;
    } else {
        $_SESSION['error'] = 'Error saving state';
        header('Location: /');
        exit;
    }
}

function save_user_crop($user_id=0, $state_id=0, $crop_id=0) {

    global $db;
    if($user_id && $state_id && $crop_id) {
        $sql = "INSERT INTO user_crops (user_id, state_id, crop_id) VALUES ($user_id, $state_id, $crop_id)";
    }

    if($db->exec($sql)) {
        $_SESSION['success'] = 'The product ' . $_POST['crop'] . ' was saved successfully. You will now receive alerts for this crop.';
        header('Location: /profile');
        exit;
    } else {
        $_SESSION['error'] = 'Error saving product';
        header('Location: /profile');
        exit;
    }
    
}

function save_deadline($deadline_id=0, $deadline_name="", $state_id=0, $crop_id=0, $deadline="") {
    global $db;

    // die all the vars
    if ($deadline_id) {
        $sql = "UPDATE crops_states_deadlines SET deadline_name = '" . $deadline_name . "', state_id = '" . $state_id . "', crop_id = '" . $crop_id . "', deadline = '" . $deadline . "' WHERE id = $deadline_id";
    } else {
        $sql = "INSERT INTO crops_states_deadlines (deadline_name, state_id, crop_id, deadline) 
        VALUES ('" . $deadline_name . "', '" . $state_id . "', '" . $crop_id . "', '" . $deadline . "')";
    
    }

    if($db->exec($sql)) {
        $_SESSION['success'] = 'Deadline saved successfully';
        header('Location: /');
        exit;
    } else {
        $_SESSION['error'] = 'Error saving deadline. Error: ' . $db->lastErrorMsg(). ' SQL: ' . $sql;
        header('Location: /');
        exit;
    }

}

function delete_crop($id) {
    global $db;
    $crop_id = $id;
    $sql = "DELETE FROM crops WHERE id = $crop_id";
    $db->exec($sql);
    $_SESSION['success'] = 'Crop deleted successfully';
    header('Location: /');
    exit;
}

function delete_state($id) {
    global $db;
    $state_id = $id;
    $sql = "DELETE FROM states WHERE id = $state_id";
    $db->exec($sql);
    $_SESSION['success'] = 'State deleted successfully';
    header('Location: /');
    exit;
}

function delete_user_crop($id) {
    global $db;
    $user_crop_id = $id;
    $sql = "DELETE FROM user_crops WHERE id = $user_crop_id";
    $db->exec($sql);
    $_SESSION['success'] = 'Product removed from your profile. You will no longer receive alerts for this product.';
    header('Location: /profile');
    exit;
}

function delete_deadline($id) {
    global $db;
    $deadline_id = $id;
    $sql = "DELETE FROM crops_states_deadlines WHERE id = $deadline_id";
    $db->exec($sql);
    $_SESSION['success'] = 'Deadline deleted successfully';
    header('Location: /');
    exit;
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

function get_crops_by_user_id($user_id) {
    global $db;
    $sql = 'SELECT * FROM user_crops WHERE user_id = ' . $user_id;
    $results = $db->query($sql);
    $crops = [];
    while ($row = $results->fetchArray()) {
        $crops[] = $row;
    }
    return $crops;
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