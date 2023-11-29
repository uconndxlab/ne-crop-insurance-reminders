<?php
require_once 'functions.php';
switch($_SERVER['REQUEST_URI']) {
    case '/':
        do_layout('pages/home');
        break;
    case '/otherstuff':
        echo 'goodbye';
        break;
    default:
        echo '404';
        break;
}