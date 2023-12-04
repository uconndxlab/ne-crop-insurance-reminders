<?php
session_start();
require_once 'functions.php';

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
    default:
        // set http response code to 404
        http_response_code(404);

        // the route attempted was: $_SERVER['REQUEST_URI'] and it was not found

        // show the 404 page
        echo "404. " . $_SERVER['REQUEST_URI'] . " not found";

        break;
}