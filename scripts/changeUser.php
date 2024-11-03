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

$fileData = $data['filedata'] ?? NULL;
$originalFileName = $data['filename'] ?? NULL;

$type = $data['type'] ?? '';
$status = $data['status'] ?? '';
$yearMin = isset($data['year_min']) ? (int)$data['year_min'] : 1900;
$yearMax =  isset($data['year_max']) ? (int)$data['year_max'] : 2025;

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
        break;
        
    case 'photo':
        $allowedExtensions = ['jpeg', 'jpg', 'png'];
        $extension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));
        
        if (!in_array($extension, $allowedExtensions)) {
            echo json_encode(["status" => "error", "message" => "Invalid file"]);
            exit;
        }
        
        $newFileName = $id_user . '.' . $extension;
        $path = 'images/userPhoto/';
        $uploadPath = '../' . $path . $newFileName;
        
        $fileContent = base64_decode($fileData);
        
        $updated = $curUser->updatePhoto($link, $id_user, $path, $newFileName);
        
        if($updated && file_put_contents($uploadPath, $fileContent)) {
            echo json_encode(["status" => "success", "message" => "Photo update successefully"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to update photo"]);
        }
        break;
        
    case 'filter':
        try {
            $query = "SELECT m.id_movie, m.name, m.type, u.status, u.rate,
                      (SELECT p.path FROM photo_movie p WHERE p.id_movie = m.id_movie LIMIT 1) AS path,
                      (SELECT p.photo FROM photo_movie p WHERE p.id_movie = m.id_movie LIMIT 1) AS photo
                      FROM rate_user_movie u
                      JOIN movie m ON u.id_movie = m.id_movie
                      WHERE u.id_user = ?";
            
            $params = [$id_user];
            $typesQuery = "i";
            
            if (!empty($status)) {
                $query .= " AND u.status = ?";
                $params[] = $status;
                $typesQuery .= "s";
            }
            
            if (!empty($type)) {
                $query .= " AND m.type = ?";
                $params[] = $type;
                $typesQuery .= "s";
            }
            
            if ($yearMin !== 1900 || $yearMax !== 2025) {
                $query .= " AND YEAR(m.date) BETWEEN ? and ?";
                $params[] = $yearMin;
                $params[] = $yearMax;
                $typesQuery .= "ii";
            }
            
            $stmt = mysqli_prepare($link, $query);

            if (!$stmt)
                throw new Exception("Error prepare query: " . mysqli_error($link));
                
            if (!mysqli_stmt_bind_param($stmt, $typesQuery, ...$params)) 
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
              
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
                
            if(!$result)
                throw new Exception("Error getting result: " . mysqli_error($link));
                    
            $listMovies = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    
            mysqli_stmt_close($stmt);
            
            echo json_encode(['movies' => $listMovies]);
            
        } catch(Exception $e) {
            error_log($e->getMessage());
            
            
            if (isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            echo json_encode(['error' => "Error filter"]);
        }
        
        break;
}
