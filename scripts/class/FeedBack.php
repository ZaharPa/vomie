<?php
namespace scripts\class;

use Exception;
use scripts\interface\FeedBackInter;

class FeedBack implements FeedBackInter
{
    public function addRate($link, $id_movie, $id_user, $rate) : bool
    {}
    
    public function editRate($link, $id_movie, $id_user, $rate) : bool
    {}

    public function addStatus($link, $id_movie, $id_user, $status) : bool
    {
        try {
            $id_movie = (int)$id_movie;
            $id_user = (int)$id_user;
            
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
            $id_movie = (int)$id_movie;
            $id_user = (int)$id_user;
            
            $query = "UPDATE rate_user_movie SET status = WHERE id_movie = ? AND id_user = ?";
            
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
            $id_movie = (int)$id_movie;
            $id_user = (int)$id_user;
            
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
    
    public function viewRate($link, $id_movie, $id_user) : array
    {}
    
    public function viewAverageRate($link, $id_movie) : float
    {}
    
    public function viewStatus($link, $id_movie, $id_user) : array
    {   }
    
    public function viewComment($link, $id_movie) : array
    {}

    public function addComment($link, $id_movie, $id_user, $comment) : bool
    {}

    public function editComment($link, $id_comment, $comment) : bool
    {}
    
    public function deleteComment($link, $id_comment) : bool
    {}
}

