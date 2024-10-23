<?php
use scripts\class\FeedBack;
use scripts\Database;

require '../vendor/autoload.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$id_user = (int)$data['id_user'];
$id_movie = (int)$data['id_movie'];
$dateCom = $data['dateCom'] ?? NULL;
$commentText = $data['commentText'] ?? '';
$option = $data['option'] ?? '';

$curUsersMovie = new FeedBack();
$db = new Database();
$link = $db->getLink();

if (isset($option) && $option === 'add') {
    if(isset($id_movie, $id_user, $commentText)) {
        $curUsersMovie->addComment($link, $id_movie, $id_user, $commentText, $dateCom);
    } 
}
