<?php
require '../vendor/autoload.php';

use scripts\Database;
use scripts\class\Movie;

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$genre = $data['genre'] ?? '';
$type = $data['type'] ?? '';
$yearMin = (int)$data['year_min'] ?? 1900;
$yearMax = (int)$data['year_max'] ?? 2025;

$link = Database::getLink();
$Movies = new Movie();

$listMovies= [];

if ($genre == '' && $type == '' && $yearMin == 1900 && $yearMax == 2025) {
    $listMovies = $Movies->viewsAllMovie($link);
} else {
    if (!empty($genre)) {
        try {
            $query = "SELECT * FROM genre_movie WHERE genre = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if (!$stmt)
                throw new Exception("Error prepare query: " . mysqli_error($link));
            
            if (!mysqli_stmt_bind_param($stmt, 's', $genre))
                throw new Exception("Error bind param: " . mysqli_stmt_error($stmt));
           
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if(!$result)
                throw new Exception("Error getting result: " . mysqli_error($link));
            
            $listIdMovies = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            if(!empty($listIdMovies)) {
                $ids = array_column($listIdMovies, 'id_movie');
                $placeholders = implode(',', array_fill(0, count($ids), '?'));
                
                if (empty($type))
                    $query = "SELECT * FROM movie WHERE id_movie IN ($placeholders) AND YEAR(date) BETWEEN ? AND ?";
                else 
                    $query = "SELECT * FROM movie WHERE id_movie IN ($placeholders) AND type = ? AND YEAR(date) BETWEEN ? AND ?";
                    
                $stmt = mysqli_prepare($link, $query);
                
                if (!$stmt)
                    throw new Exception("Error prepare query: " . mysqli_error($link));
                    
                $types = str_repeat('i', count($ids));
                if (empty($type)) {
                    $params = array_merge($ids, [$yearMin, $yearMax]);
                    mysqli_stmt_bind_param($stmt, $types . 'ii', ...$params);
                }
                else {
                    $params = array_merge($ids, [$type, $yearMin, $yearMax]);
                    mysqli_stmt_bind_param($stmt, $types . 'sii', ...$params);
                }
                
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                        
                 if(!$result)
                    throw new Exception("Error getting result: " . mysqli_error($link));
                            
                  $listMovies = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
            mysqli_stmt_close($stmt);
        } catch(Exception $e) {
            error_log($e->getMessage());  
            
            
            if (isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
        }
    } else {
        try { 
            if (empty($type))
                $query = "SELECT * FROM movie WHERE YEAR(date) BETWEEN ? AND ?";
            else 
                $query = "SELECT * FROM movie WHERE type = ? AND YEAR(date) BETWEEN ? AND ?";
            
            $stmt = mysqli_prepare($link, $query);

            if (!$stmt)
                throw new Exception("Error prepare query: " . mysqli_error($link));
                
            if (empty($type)) {
                if (!mysqli_stmt_bind_param($stmt, 'ii', $yearMin, $yearMax)) {
                    throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
                } 
            } else {
                if (!mysqli_stmt_bind_param($stmt, 'sii', $type, $yearMin, $yearMax)) {
                    throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
                }
            }
            
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
                    
            if(!$result)
                throw new Exception("Error getting result: " . mysqli_error($link));
         
             $listMovies = mysqli_fetch_all($result, MYSQLI_ASSOC);

             mysqli_stmt_close($stmt);
        } catch(Exception $e) {
            error_log($e->getMessage());
            
            
            if (isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
        }
    }
}

echo json_encode(['movies' => $listMovies]);