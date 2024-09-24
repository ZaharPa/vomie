<?php
require 'vendor/autoload.php';

session_start();


if (isset($_GET['logOut'])){
    session_destroy();
    header("Location: index.php?page=main");
}

$page = isset($_GET['page']) ? $_GET['page'] : 'main';

$title = $page;

if ($page != 'register' && $page != 'login')
    include 'include/header.php';

switch($page) {
    case 'register':
        include 'pages/register.php';
        break;
    case 'login':
        include 'pages/login.php';
        break;
    case 'add-movie':
        include 'pages/addMovie.php';
        break;
    case 'view-all':
        include 'pages/viewAllMovies.php';
        break;
    case 'movieDetail':
        include 'pages/movieDetail.php';
        break;
    default:
        include 'pages/main.php';
        break;
}

if ($page != 'register' && $page != 'login')
    include 'include/footer.php';