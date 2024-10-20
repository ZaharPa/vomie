<?php
use scripts\class\FeedBack;
use scripts\Database;

require '../vendor/autoload.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$id_user = (int)$data['id_user'];
$id_movie = (int)$data['id_movie']; 
$rate = $data['rate'] ?? '';
$status = $data['status'] ?? '';

$curUsersMovie = new FeedBack();
$db = new Database();
$link = $db->getLink();

if (isset($id_movie, $id_user, $status) && $status !=='') {    
    $validStatus = ['Watching', 'Completed', 'Postponed', 'Abondoned', 'Delete'];
    
    if (!in_array($status, $validStatus)) {
        echo json_encode(['error' => 'Invalid status']);
        exit;
    }    
    
    if ($status === 'Delete') {
        $curUsersMovie->editStatus($link, $id_movie, $id_user, NULL);
        exit;
    }
    
    if ($curUsersMovie->IsStatus($link, $id_movie, $id_user) === true) {
        $curUsersMovie->editStatus($link, $id_movie, $id_user, $status);
    } else {
        $curUsersMovie->addStatus($link, $id_movie, $id_user, $status);
    }
} 

if (isset($id_movie, $id_user, $rate) && $rate !== '') {
    if ($curUsersMovie->IsStatus($link, $id_movie, $id_user) === true) {
        $curUsersMovie->editRate($link, $id_movie, $id_user, $rate);
    } else {
        $curUsersMovie->addRate($link, $id_movie, $id_user, $rate);
    }
} 

if (isset($link)) {
    $link->close();
}

exit;
