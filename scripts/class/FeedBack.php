<?php
namespace scripts\class;

use Exception;
use scripts\interface\FeedBackInter;

class FeedBack implements FeedBackInter
{
    public function addRate($link, $id_movie, $id_user, $rate) : bool
    {
        try {
            $query = "INSERT INTO rate_user_movie(id_movie, id_user, rate) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($link, $query);
            
            if (!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            mysqli_stmt_bind_param($stmt, 'iid', $id_movie, $id_user, $rate);
            $result = mysqli_stmt_execute($stmt);
            
            if ($result === false) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            return true;
            
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            if (isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }
    
    public function editRate($link, $id_movie, $id_user, $rate) : bool
    {
        try {
            $query = "UPDATE rate_user_movie SET rate = ? WHERE id_movie = ? AND id_user = ?";
            
            $stmt = mysqli_prepare($link, $query);
            
            if ($stmt === false) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if (!mysqli_stmt_bind_param($stmt, 'dii', $rate, $id_movie, $id_user)) {
                throw new Exception("Error prepare parameters: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_execute($stmt);
            
            if ($result === false) {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            if(isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }

    public function addStatus($link, $id_movie, $id_user, $status) : bool
    {
        try {
            $query = "INSERT INTO rate_user_movie(id_movie, id_user, status) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($link, $query);
            
            if (!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            mysqli_stmt_bind_param($stmt, 'iis', $id_movie, $id_user, $status);
            $result = mysqli_stmt_execute($stmt);
            
            if ($result === false) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            } 
            
            mysqli_stmt_close($stmt);
            return true;
            
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            if (isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }

    public function editStatus($link, $id_movie, $id_user, $status) : bool
    {
        try {
            $query = "UPDATE rate_user_movie SET status = ? WHERE id_movie = ? AND id_user = ?";
            
            $stmt = mysqli_prepare($link, $query);
            
            if ($stmt === false) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if (!mysqli_stmt_bind_param($stmt, 'sii', $status, $id_movie, $id_user)) {
                throw new Exception("Error prepare parameters: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_execute($stmt);
            
            if ($result === false) {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            if(isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }
    
    public function IsStatus($link, $id_movie, $id_user) : bool
    {
        try {
            $query = "SELECT COUNT(*) as count FROM rate_user_movie WHERE id_movie = ? AND id_user = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if ($stmt === false) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if (!mysqli_stmt_bind_param($stmt, 'ii', $id_movie, $id_user)) {
                throw new Exception("Error prepare parameters: " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
            
            if ($row = $result->fetch_assoc()) {
                return $row['count'] > 0;
            }
            
        } catch(Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
                        
            return false;
        }
        
        if (isset($stmt) && $stmt !== false) {
            mysqli_stmt_close($stmt);
        }
        
        return false;
    }
    
    public function viewRate($link, $id_movie, $id_user) : ?string
    {
        try {
            $query = "SELECT rate FROM rate_user_movie WHERE id_movie = ? AND id_user = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'ii', $id_movie, $id_user)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_get_result($stmt);
            
            
            $row = mysqli_fetch_assoc($result);
            
            mysqli_stmt_close($stmt);
            
            return $row['rate'] / 2;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            if (isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
                
                return NULL;
        }
    }
    
    public function viewAverageRate($link, $id_movie) : ?float
    {
        try {
            $query = "SELECT AVG(rate) as average_rating FROM rate_user_movie WHERE id_movie = ?";
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
            
            
            $row = mysqli_fetch_assoc($result);
            
            mysqli_stmt_close($stmt);
            
            return $row['average_rating'];
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            if (isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
                
                return NULL;
        }
    }
    
    public function viewStatus($link, $id_movie, $id_user) : ?string
    {
        try {
            $query = "SELECT status FROM rate_user_movie WHERE id_movie = ? AND id_user = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'ii', $id_movie, $id_user)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_get_result($stmt);
            
            $row = mysqli_fetch_assoc($result);
            
            mysqli_stmt_close($stmt);
            
            return $row['status'] ?? NULL;       
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            if (isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
            
            return NULL;
        }
    }
    
    public function viewComment($link, $id_movie) : array
    {
        try {
            $query = "SELECT comment.*, user.name as name_user 
                FROM comment
                INNER JOIN user ON comment.id_user = user.id_user 
                WHERE id_movie = ?";
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
            
            $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            mysqli_stmt_close($stmt);
            
            return $comments;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            if (isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
                
                return NULL;
        }
    }

    public function addComment($link, $id_movie, $id_user, $comment, $date) : bool
    {
        try {
            $query = "INSERT INTO comment(comment, date, id_user, id_movie) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $query);
            
            if (!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            mysqli_stmt_bind_param($stmt, 'ssii', $comment, $date, $id_user, $id_movie);
            $result = mysqli_stmt_execute($stmt);
            
            if ($result === false) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_close($stmt);
            return true;
            
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            if (isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }
    
    public function deleteComment($link, $id_comment) : bool
    {
        try {            
            $query = "DELETE FROM comment WHERE id_comment = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if (!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if (!mysqli_stmt_bind_param($stmt, 'i', $id_comment)) {
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
    
    public function viewAllComments($link) : array
    {
        try {
            $query = "SELECT c.comment, c.date, u.name AS user_name, m.id_movie, m.name AS movie_name 
                      FROM comment c 
                      LEFT JOIN user u ON c.id_user = u.id_user
                      LEFT JOIN movie m ON c.id_movie = m.id_movie
                      ORDER BY date DESC, id_comment DESC";
            $result = mysqli_query($link, $query);
            
            if (!$result)
                throw new Exception("Error " . mysqli_error($link));
                
            $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
            mysqli_free_result($result);
                
            return $comments;
        } catch (Exception $e){
            error_log($e->getMessage() . "Query: " .$query);
            
            return [];
        }
    }
}

