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
    {
        try {
            $id = (int)$id;
            
            $query = "DELETE FROM movie WHERE id_movie = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if (!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if (!mysqli_stmt_bind_param($stmt, 'i', $id)) {
                throw new Exception("Error prepare parameters: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_execute($stmt);
            
            if (!$result) {
                throw new Exception("Error executing statement: " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            
            return true;
            
        } catch (Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            if(isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        } 
    }

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
    
    public function editGenre($link, $id_movie, $id_genre, $genre): bool
    {}
    
    public function deleteGenre($link, $id_movie) : bool
    {
        try {
            $id_movie = (int)$id_movie;
            
            $query = "DELETE FROM genre_movie WHERE id_movie = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if (!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if (!mysqli_stmt_bind_param($stmt, 'i', $id_movie)) {
                throw new Exception("Error prepare parameters: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_execute($stmt);
            
            if (!$result) {
                throw new Exception("Error executing statement: " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            
            return true;
            
        } catch (Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            if(isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        } 
    }
    
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
    
    public function editPhoto($link, $id_movie, $id_photo, $path, $photo) : bool
    {}
    
    public function deletePhoto($link, $id_movie) : bool
    {
        try {
            $id_movie = (int)$id_movie;
            
            $query = "DELETE FROM photo_movie WHERE id_movie = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if (!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if (!mysqli_stmt_bind_param($stmt, 'i', $id_movie)) {
                throw new Exception("Error prepare parameters: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_execute($stmt);
            
            if (!$result) {
                throw new Exception("Error executing statement: " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            
            return true;
            
        } catch (Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            if(isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        } 
    }
    
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
    
    public function editCast($link, $id_movie, $id_cast, $name, $role, $path, $photo) : bool
    {}
    
    public function deleteCast($link, $id_movie) : bool
    {
        try {
            $id_movie = (int)$id_movie;
            
            $query = "DELETE FROM cast_movie WHERE id_movie = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if (!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if (!mysqli_stmt_bind_param($stmt, 'i', $id_movie)) {
                throw new Exception("Error prepare parameters: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_execute($stmt);
            
            if (!$result) {
                throw new Exception("Error executing statement: " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            
            return true;
            
        } catch (Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            if(isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        } 
    }
    
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
    
    public function editLink($link, $id_movie, $id_link, $link_movie) : bool
    {}
    
    public function deleteLink($link, $id_movie) : bool
    {
        try {
            $id_movie = (int)$id_movie;
            
            $query = "DELETE FROM link_movie WHERE id_movie = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if (!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if (!mysqli_stmt_bind_param($stmt, 'i', $id_movie)) {
                throw new Exception("Error prepare parameters: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_execute($stmt);
            
            if (!$result) {
                throw new Exception("Error executing statement: " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            
            return true;
            
        } catch (Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            if(isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        } 
    }
    
    public function setIdMovie($id) : void
    {
       $this->id = $id;
    }
    
    public function getIdMovie() : ?string
    {
        return $this->id;
    }
    
    public function viewsAllMovie($link) : array
    {
        try {
            $query = "SELECT * FROM movie ORDER BY id_movie DESC, views DESC";
            $result = mysqli_query($link, $query);
            
            if (!$result)
                throw new Exception("Error " . mysqli_error($link));
            
            $movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            mysqli_free_result($result);
            
            return $movies;
        } catch (Exception $e){
            error_log($e->getMessage() . "Query: " .$query);
            
            return [];
        }
    }
    
    public function viewOneMovie($link, $id) : array
    {
        try{
            $id = (int)$id;
            
            $query = "SELECT * FROM movie WHERE id_movie = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'i', $id)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($result) === 0) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            }
            
            $movie = mysqli_fetch_assoc($result);
            
            mysqli_stmt_close($stmt);
            
            return $movie;            
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            if(isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
            
            return [];
        }
    }
    
    public function viewPhotosMovie($link) : array
    {
        try {
            $query = "SELECT * FROM photo_movie ORDER BY id_photo ASC";
            $result = mysqli_query($link, $query);
            
            if (!$result)
                throw new Exception("Error " . mysqli_error($link));
                
                $photosMovies = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                mysqli_free_result($result);
                
                return $photosMovies;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            return [];
        }
    }
    
    public function viewAddInfoForMovie($link, $id_movie) : array
    {
        try {
            $query = "SELECT gm.genre, lm.link, pm.path AS movie_path, pm.photo AS movie_photo, cm.path AS cast_path, cm.photo AS cast_photo 
                      FROM genre_movie gm
                      INNER JOIN link_movie lm ON gm.id_movie = lm.id_movie
                      INNER JOIN photo_movie pm ON gm.id_movie = pm.id_movie
                      INNER JOIN cast_movie cm ON gm.id_movie = cm.id_movie
                      WHERE gm.id_movie = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'i', $id_movie)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_get_result($stmt);
            
            if (!$result) {
                throw new Exception("Помилка отримання результату: " . mysqli_stmt_error($stmt));
            }
            
            $movieAddInfo = [];
            
            while ($row = mysqli_fetch_assoc($result)) {
                $movieAddInfo[] = $row;
            }
            
            mysqli_stmt_close($stmt);
            
            return $movieAddInfo;            
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query" . $query);
            
            if (isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
            
            return [];
        }
    }
    
    public function viewGenreForMovie($link, $id_movie) : array 
    {
        try {
            $query = "SELECT genre FROM genre_movie  WHERE id_movie = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'i', $id_movie)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_get_result($stmt);
            
            if (!$result) {
                throw new Exception("Помилка отримання результату: " . mysqli_stmt_error($stmt));
            }
            
            $movieGenre = [];
            
            while ($row = mysqli_fetch_assoc($result)) {
                $movieGenre[] = $row;
            }
            
            mysqli_stmt_close($stmt);
            
            return $movieGenre;
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query" . $query);
            
            if (isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
                
                return [];
        }
    }
    
    public function viewLinkForMovie($link, $id_movie) : array
    {
        try {
            $query = "SELECT name, link FROM link_movie WHERE id_movie = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'i', $id_movie)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_get_result($stmt);
            
            if (!$result) {
                throw new Exception("Помилка отримання результату: " . mysqli_stmt_error($stmt));
            }
            
            $movielink = [];
            
            while ($row = mysqli_fetch_assoc($result)) {
                $movielink[] = $row;
            }
            
            mysqli_stmt_close($stmt);
            
            return $movielink;
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query" . $query);
            
            if (isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
                
                return [];
        }
    }
    public function viewPhotoForMovie($link, $id_movie) : array
    {
        try {
            $query = "SELECT path, photo FROM photo_movie  WHERE id_movie = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'i', $id_movie)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_get_result($stmt);
            
            if (!$result) {
                throw new Exception("Помилка отримання результату: " . mysqli_stmt_error($stmt));
            }
            
            $moviePhoto = [];
            
            while ($row = mysqli_fetch_assoc($result)) {
                $moviePhoto[] = $row;
            }
            
            mysqli_stmt_close($stmt);
            
            return $moviePhoto;
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query" . $query);
            
            if (isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
                
                return [];
        }
    }
    public function viewCastForMovie($link, $id_movie) : array
    {
        try {
            $query = "SELECT name, role, path, photo FROM cast_movie  WHERE id_movie = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'i', $id_movie)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_get_result($stmt);
            
            if (!$result) {
                throw new Exception("Помилка отримання результату: " . mysqli_stmt_error($stmt));
            }
            
            $movieCast = [];
            
            while ($row = mysqli_fetch_assoc($result)) {
                $movieCast[] = $row;
            }
            
            mysqli_stmt_close($stmt);
            
            return $movieCast;
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query" . $query);
            
            if (isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
                
                return [];
        }
    }
}
