<?php
require 'vendor/autoload.php';

session_start();


if (isset($_GET['logOut'])){
    session_destroy();
    header("Location: index.php?page=main");
}

$page = isset($_GET['page']) ? $_GET['page'] : 'main';

if ($page != 'register')
    include 'include/header.php';

switch($page) {
    case 'register':
        include 'pages/register.php';
        break;
    default:
        include 'pages/main.php';
}