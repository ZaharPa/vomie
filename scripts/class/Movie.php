<?php
namespace scripts\class;

use Exception;
use scripts\interface\MovieInterface;

class Movie implements MovieInterface
{
    private $id;

    private function executeQuery($link, string $query, string $types, ...$params)
    {
        $stmt = mysqli_prepare($link, $query);
        if (!$stmt) {
            throw new Exception("Error prepare query: " . mysqli_error($link));
        }
        
        if(!mysqli_stmt_bind_param($stmt, $types, ...$params)) {
            throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
        }
        
        if(!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
        }
        
        return $stmt;
    }
    
    public function addMovie($link, $name, $date, $description, $status, $type, $duration) : bool
    {
        try {
            $query = "INSERT INTO movie(name, date, description, status, type, duration) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->executeQuery($link, $query, 'ssssss', $name, $date, $description, $status, $type, $duration);
            $this->setIdMovie(mysqli_insert_id($link));         
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            echo '<script type="text/javascript">',
            'showModal("An error occurred with movie. Please try again later.");',
            '</script>';
            
            return false; 
        }
    }
    
    public function editMovie($link, $id, $name, $date, $description, $status, $type, $duration) : bool
    {
        try {
            $id_movie = (int)$id;
            
            $query = "UPDATE movie SET name = ?, date = ?, description = ?, 
                    status = ?, type = ?, duration = ? WHERE id_movie = ?";
           
            $stmt = $this->executeQuery($link, $query, 'ssssssi', $name, $date, $description, $status, $type, $duration, $id_movie);
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            echo '<script type="type/javascript">',
                'showModal("An error occurred with movie. Please try again later.");',
                '</script>';
            
            return false;
        }
    }
    
    public function deleteMovie($link, $id) : bool
    {
        try {
            $id = (int)$id;
            
            $query = "DELETE FROM movie WHERE id_movie = ?";
            $stmt = $this->executeQuery($link, $query, 'i', $id);
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
           
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
            $query = "SELECT * FROM movie ORDER BY id_movie DESC";
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
            $stmt = $this->executeQuery($link, $query, 'i', $id);
            $result = mysqli_stmt_get_result($stmt);
            $movie = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            
            return $movie;            
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            return [];
        }
    }
    
    public function viewMovieForSlider($link) : array
    {
        try {
            $query = "SELECT m.id_movie, m.name, m.description, m.date, rm.avg_rate
                      FROM movie m 
                      JOIN (
                          SELECT id_movie, AVG(rate) AS avg_rate
                          FROM rate_user_movie
                          GROUP BY id_movie
                          HAVING avg_rate > 7
                      ) AS rm on m.id_movie = rm.id_movie                        
                      ORDER BY m.date DESC
                      LIMIT 10";
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
    
    public function viewMovieByGenre($link, string $genre) : array
    {
        try{
            $query = "SELECT m.* FROM movie m 
                      JOIN genre_movie g ON m.id_movie = g.id_movie
                      WHERE g.genre = ?";            
            $stmt = $this->executeQuery($link, $query, 's', $genre);                  
            $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($result) === 0) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            }

            $movie = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_stmt_close($stmt);
            
            return $movie;
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
                
            return [];
        }
    }
}
