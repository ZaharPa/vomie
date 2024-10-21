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
    
    public function deleteRateAndStatus($link, $id_movie, $id_user) : bool
    {} 
    
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
            
            return $row['rate'] / 2 ?? NULL;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            if (isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
                
                return NULL;
        }
    }
    
    public function viewAverageRate($link, $id_movie) : float
    {}
    
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
            $query = "SELECT * FROM comment WHERE id_movie = ?";
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

    public function addComment($link, $id_movie, $id_user, $comment) : bool
    {}

    public function editComment($link, $id_comment, $comment) : bool
    {}
    
    public function deleteComment($link, $id_comment) : bool
    {}
}

