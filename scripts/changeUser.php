<?php
use scripts\Database;
use scripts\class\Viewer;

require '../vendor/autoload.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$id_user = isset($data['id_user']) ? (int)$data['id_user'] : NULL;
$option = $data['option'] ?? NULL;
$newName = $data['newName'] ?? NULL;
$oldPass = $data['oldPass'] ?? NULL;
$newPass = $data['newPass'] ?? NULL;

$link = Database::getLink();
$curUser = new Viewer();
switch ($option) {
    case 'name':
        if ($id_user && $newName) {
            $updated =$curUser->updateName($link, $id_user, $newName);
            if ($updated) {
                echo json_encode(["status" => "success", "message" => "Name update successefully"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to update name"]);
            }
        }
        break;
    case 'pass':
        if ($id_user && $oldPass && $newPass) {
            $updated = $curUser->updatePass($link, $id_user, $newPass, $oldPass);
            if ($updated) {
                echo json_encode(["status" => "success", "message" => "Password update successefully"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to update password"]);
            }
        }
}
