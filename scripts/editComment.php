<?php
use scripts\class\FeedBack;
use scripts\Database;

require '../vendor/autoload.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$id_user = isset($data['id_user']) ? (int)$data['id_user'] : NULL;
$id_movie = isset($data['id_movie']) ? (int)$data['id_movie'] : NULL;
$id_comment = isset($data['id_comment']) ? (int)$data['id_comment'] : NULL;
$dateCom = $data['dateCom'] ?? NULL;
$commentText = $data['commentText'] ?? '';
$option = $data['option'] ?? '';

$curUsersMovie = new FeedBack();
$db = new Database();
$link = $db->getLink();

switch ($option) {
    case 'add':
        if(isset($id_movie, $id_user, $commentText)) {
            $curUsersMovie->addComment($link, $id_movie, $id_user, $commentText, $dateCom);
            exit;
        } 
        break;
    case 'view':
        if (isset($id_movie)) {
            $comments = $curUsersMovie->viewComment($link, $id_movie);
            echo json_encode($comments);
            exit;
        }
        break;
    case 'delete':
        if (isset($id_comment)) {
            $curUsersMovie->deleteComment($link, $id_comment);
            exit;
        }
        break;
}
