<?php
namespace scripts\class;

use Exception;
use scripts\interface\Entartaiment;

class Movie implements Entartaiment
{

    public function addMovie($link, $name, $date, $description, $status, $type, $duration)
    {
        try {
            $query = "INSERT INTO (name, date, description, status, type, duration) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $query);
            
            if (!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            mysqli_stmt_bind_param($stmt, 'ssssss', $name, $date, $description, $status, $type, $duration);
            $result = mysqli_stmt_execute($stmt);
            
            if ($result === false) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            } 
            
            mysqli_stmt_close($stmt);
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo '<script type="text/javascript">',
            'showModal("An error occurred. Please try again later.");',
            '</script>';
            
            if(isset($stmt)) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
        
    }
    
    public function editMovie($link, $id, $name, $date, $description, $status, $type, $duration)
    {}
    
    public function deleteMovie($link, $id)
    {}

    public function addGenre($link, $id_movie, $genre) 
    {}
    
    public function editGenre($link, $id_genre, $id_movie, $genre)
    {}
    
    public function deleteGenre($link, $id_genre)
    {}
    
    public function addPhoto($link, $id_movie, $path, $photo)
    {}
    
    public function editPhoto($link, $id_photo, $id_movie, $path, $photo)
    {}
    
    public function deletePhoto($link, $id_photo)
    {}
    
    public function addCast($link, $id_movie, $name, $role, $path, $photo)
    {}
    
    public function editCast($link, $id_cast, $id_movie, $name, $role, $path, $photo)
    {}
    
    public function deleteCast($link, $id_cast)
    {}
    
    public function addLink($link, $id_movie, $name, $link_movie)
    {}
    
    public function editLink($link, $id_link, $id_movie, $link_movie)
    {}
    
    public function deleteLink($link, $id_link)
    {}
    
    public function viewsAllMovie($link)
    {}
    
    public function viewOneMovie($link, $id)
    {}
    
}

