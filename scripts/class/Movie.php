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
            error_log($e->getMessage() . " Query: " . $query);
            echo '<script type="text/javascript">',
            'showModal("An error occurred with movie. Please try again later.");',
            '</script>';
            
            if (isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
        
    }
    
    public function editMovie($link, $id, $name, $date, $description, $status, $type, $duration) : bool
    {}
    
    public function deleteMovie($link, $id) : bool
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
            error_log($e->getMessage() . " Query: " . $query);
            echo '<script type="text/javascript">',
            'showModal("An error occurred with genre. Please try again later.");',
            '</script>';
            
            if (isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }
    
    public function editGenre($link, $id_genre, $id_movie, $genre): bool
    {}
    
    public function deleteGenre($link, $id_genre) : bool
    {}
    
    public function addPhoto($link, $id_movie, $path, $photo) : bool
    {
        try {
            $query = "INSERT INTO photo_movie(id_movie, path, photo) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'iss', $id_movie, $path, $photo)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_execute($stmt);
            
            if ($result === false) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            echo '<script type="text/javascript">',
            'showModal("An error occurred with photo. Please try again later.");',
            '</script>';
            
            if (isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }
    
    public function editPhoto($link, $id_photo, $id_movie, $path, $photo) : bool
    {}
    
    public function deletePhoto($link, $id_photo) : bool
    {}
    
    public function addCast($link, $id_movie, $name, $role, $path = null, $photo = null) : bool
    {
        try {
            if ($photo != null)
                $query = "INSERT INTO cast_movie(id_movie, name, role, path, photo) VALUES (?, ?, ?, ?, ?)";
            else 
                $query = "INSERT INTO cast_movie(id_movie, name, role) VALUES (?, ?, ?)";    
            
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if ($photo != null) {
                if(!mysqli_stmt_bind_param($stmt, 'issss', $id_movie, $name, $role, $path, $photo)) 
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
            error_log($e->getMessage() . " Query: " . $query);
            echo '<script type="text/javascript">',
            'showModal("An error occurred with cast. Please try again later.");',
            '</script>';
            
            if (isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }
    
    public function editCast($link, $id_cast, $id_movie, $name, $role, $path, $photo) : bool
    {}
    
    public function deleteCast($link, $id_cast) : bool
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
            error_log($e->getMessage() . " Query: " . $query);
            echo '<script type="text/javascript">',
            'showModal("An error occurred with link. Please try again later.");',
            '</script>';
            
            if (isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }
    
    public function editLink($link, $id_link, $id_movie, $link_movie) : bool
    {}
    
    public function deleteLink($link, $id_link) : bool
    {}
    
    public function setIdMovie($id) : void
    {
       $this->id = $id;
    }
    
    public function getIdMovie() : ?string
    {
        return $this->id;
    }
    
    public function viewsAllMovie($link) : array
    {}
    
    public function viewOneMovie($link, $id) : object
    {}
    
}

