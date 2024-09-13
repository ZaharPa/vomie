<?php
namespace scripts\class;

use Exception;
use scripts\interface\Entartaiment;

class Movie implements Entartaiment
{
    private $id;

    
    public function addMovie($link, $name, $date, $description, $status, $type, $duration) : bool
    {
        try {
            $query = "INSERT INTO movie(name, date, description, status, type, duration) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $query);
            
            if (!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            mysqli_stmt_bind_param($stmt, 'ssssss', $name, $date, $description, $status, $type, $duration);
            $result = mysqli_stmt_execute($stmt);
            
            if ($result === false) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            } else {
               $this->setIdMovie(mysqli_insert_id($link));
            }
            
            mysqli_stmt_close($stmt);
            return true;
            
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

    public function addGenre($link, $id_movie, $genre) : bool
    {
        try {
            $query = "INSERT INTO genre_movie(id_movie, genre) VALUES (?, ?)";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'is', $id_movie, $genre)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_execute($stmt);
            
            if ($result === false) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo '<script type="text/javascript">',
                'showModal("An error occured. Please try again later.");',
                '</script>';
            
            if (isset($stmt)) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }
    
    public function editGenre($link, $id_genre, $id_movie, $genre)
    {}
    
    public function deleteGenre($link, $id_genre)
    {}
    
    public function addPhoto($link, $id_movie, $photo) : bool
    {
        try {
            $query = "INSERT INTO photo_movie(id_movie, photo) VALUES (?, ?)";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'is', $id_movie, $photo)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_execute($stmt);
            
            if ($result === false) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo '<script type="text/javascript">',
            'showModal("An error occured. Please try again later.");',
            '</script>';
            
            if (isset($stmt)) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }
    
    public function editPhoto($link, $id_photo, $id_movie, $path, $photo)
    {}
    
    public function deletePhoto($link, $id_photo)
    {}
    
    public function addCast($link, $id_movie, $name, $role, $photo = null) : bool
    {
        try {
            if ($photo != null)
                $query = "INSERT INTO cast_movie(id_movie, name, role, photo) VALUES (?, ?, ?, ?)";
            else 
                $query = "INSERT INTO cast_movie(id_movie, name, role) VALUES (?, ?, ?)";    
            
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if ($photo != null) {
                if(!mysqli_stmt_bind_param($stmt, 'isss', $id_movie, $name, $role, $photo)) 
                    throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            } else {
                if(!mysqli_stmt_bind_param($stmt, 'iss', $id_movie, $name, $role))
                    throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_execute($stmt);
            
            if ($result === false) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo '<script type="text/javascript">',
            'showModal("An error occured. Please try again later.");',
            '</script>';
            
            if (isset($stmt)) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }
    
    public function editCast($link, $id_cast, $id_movie, $name, $role, $path, $photo)
    {}
    
    public function deleteCast($link, $id_cast)
    {}
    
    public function addLink($link, $id_movie, $name, $link_movie) : bool
    {
        try {
            $query = "INSERT INTO link_movie(id_movie, name, link) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'iss', $id_movie, $name, $link_movie)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_execute($stmt);
            
            if ($result === false) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            echo '<script type="text/javascript">',
            'showModal("An error occured. Please try again later.");',
            '</script>';
            
            if (isset($stmt)) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }
    
    public function editLink($link, $id_link, $id_movie, $link_movie)
    {}
    
    public function deleteLink($link, $id_link)
    {}
    
    public function setIdMovie($id) : void
    {
       $this->id = $id;
    }
    
    public function getIdMovie() : ?string
    {
        return $this->id;
    }
    
    public function viewsAllMovie($link)
    {}
    
    public function viewOneMovie($link, $id)
    {}
    
}

