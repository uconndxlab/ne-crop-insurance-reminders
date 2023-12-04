<?php
session_start();
require_once 'functions.php';
check_session();

// get the request method
$method = $_SERVER['REQUEST_METHOD'];


switch($_SERVER['REQUEST_URI']) {
    case '/':
        do_layout('pages/home');
        break;
    case '/profile':
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
        $crop_id = $_POST['crop_id'];
        delete_crop($crop_id);
        break;
    // case post/crop/save/
    case '/post/crop/save':
        $crop_id = $_POST['crop_id'];
        save_crop($crop_id);
        break;
    case '/post/profile/save':
        $user_id = $_SESSION['user_id'];
        save_profile($user_id);
        break;
    default:
        // set http response code to 404
        http_response_code(404);

        // the route attempted was: $_SERVER['REQUEST_URI'] and it was not found

        // show the 404 page
        echo "404. " . $_SERVER['REQUEST_URI'] . " not found";

        break;
}