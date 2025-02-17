<?php
session_start();
require_once 'functions.php';


// get the request method
$method = $_SERVER['REQUEST_METHOD'];


switch ($_SERVER['REQUEST_URI']) {
    case '/':
        check_session();

        if ($_SESSION['user_type'] == 'admin') : 
            do_layout('pages/home');
        else :
            do_layout('pages/profile');
        endif;
        break;
    case '/profile':
        check_session();
        do_layout('pages/profile');
        break;
    case '/post/login':

        do_login();
        break;
    case '/logout':
        do_logout();
        break;
    case '/post/register':

        do_register();
        break;
    case '/login':
        do_layout('pages/login');
        break;
    case '/register':
        do_layout('pages/register');
        break;
        // case post/crop/delete/{id}
    case '/post/crop/delete':
        check_session();
        $crop_id = $_POST['crop_id'];
        delete_crop($crop_id);
        break;
        // case post/crop/save/
    case '/post/crop/save':
        check_session();
        $crop_id = $_POST['crop_id'];
        save_crop($crop_id);
        break;
    case '/post/state/save':
        $state_id = $_POST['state_id'];
        save_state($state_id);
        break;
    case '/post/state/delete':
        check_session();
        $state_id = $_POST['state_id'];
        delete_state($state_id);
        break;
    case '/post/profile/save':
        check_session();
        $user_id = $_SESSION['user_id'];
        save_profile($user_id);
        break;
    case '/post/user_crop/delete':
        check_session();
        $user_crop_id = $_POST['user_crop_id'];
        delete_user_crop($user_crop_id);
        break;

    case '/post/user_crop/save':
        check_session();
        $user_id = $_SESSION['user_id'];
        $state_id = $_POST['state_id'];
        $crop_id = $_POST['crop_id'];
        save_user_crop($user_id, $state_id, $crop_id);
        break;
    case '/post/deadline/save':
        check_session();
        $state_id = $_POST['state_id'];
        $crop_id = $_POST['crop_id'];
        $deadline_name = $_POST['deadline_name'];
        $deadline = $_POST['deadline'];
        //$deadline_name="", $state_id=0, $crop_id=0, $deadline=""
        save_deadline(0, $deadline_name, $state_id, $crop_id, $deadline);
        break;
    case '/post/deadline/delete':
        check_session();
        $deadline_id = $_POST['deadline_id'];
        delete_deadline($deadline_id);
        break;

    case '/post/user/delete':
        check_session();
        $user_id = $_POST['user_id'];
        delete_user($user_id);
        break;
    case '/post/deadline/notify':
        check_session();
        // get all the users for the deadline
        $deadline_id = $_POST['deadline_id'];
        $deadline = get_deadline($deadline_id);
        $users = get_users_for_deadline($deadline);
        $successful_deliveries = 0;
        $total_users = count($users);
        // loop through the users and send them an email
        foreach ($users as $user) {
            $user = get_user($user['user_id']);
            $reminder_sent = send_reminder_email($user, $deadline);
            if ($reminder_sent) {
                $successful_deliveries++;
            }
        }
        $msg_type = "success";
        if ($successful_deliveries == 0) {
            $msg_type = "error";
        }

        if($successful_deliveries != $total_users){
            $msg_type = "error";
            $msg = "Sent reminders to " . $successful_deliveries . " out of " . $total_users . " users";
        } else {
            $msg = "Sent reminders to all " . $total_users . " users";
        }

        $_SESSION[$msg_type] = $msg;

        header('Location: /');
        
        break;
    default:
        // set http response code to 404
        http_response_code(404);

        // the route attempted was: $_SERVER['REQUEST_URI'] and it was not found

        // show the 404 page
        echo "404. " . $_SERVER['REQUEST_URI'] . " not found";

        break;
}
