<?php
use scripts\class\FeedBack;
use scripts\Database;

require 'vendor/autoload.php';

if (isset($_POST['id_movie'], $_POST['id_user'], $_POST['status'])) {
    $id_movie = $_POST['id_movie'];
    $id_user = $_POST['id_user'];
    $status = $_POST['status'];
    
    $validStatus = ['Watching', 'Completed', 'Postponed', 'Abondoned', 'Delete'];
    
    if (!in_array($status, $validStatus)) {
        echo json_encode(['error' => 'Invalid status']);
        exit;
    }
    
    $curUsersMovie = new FeedBack();
    $link = new Database();
    
    if ($status === 'Delete') {
        $curUsersMovie->editStatus($link, $id_movie, $id_user, NULL);
        exit;
    }
    
    if ($curUsersMovie->IsStatus($link, $id_movie, $id_user) === true) {
        $curUsersMovie->editStatus($link, $id_movie, $id_user, $status);
    } else {
        $curUsersMovie->addStatus($link, $id_movie, $id_user, $status);
    }
    
    if (isset($link)) {
        $link->close();
    }
    
    exit;
} else {
    echo json_encode(['error' => 'Missing required parameters']);
    exit;
}