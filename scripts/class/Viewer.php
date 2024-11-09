<?php
namespace scripts\class;

use Exception;
use scripts\interface\User;

class Viewer implements User
{
    private $name;
    private $role;
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
    
    private function fetchUserAttribute($link, string $email, string $attribute)
    {
        $data = NULL;
        
        $query = "SELECT {$attribute} FROM user WHERE email = ?";
        $stmt = mysqli_prepare($link, $query);
        
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $data =$row[$attribute];
        }
            
        mysqli_stmt_close($stmt);
        return $data;
    }
    
    private function hash_pass_user($password) :string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    
    public function setName( $link, string $email): void    
    {
        $this->name = $this->fetchUserAttribute($link, $email, 'name');
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    
    public function setId( $link, string $email): void
    {
        $this->id = $this->fetchUserAttribute($link, $email, 'id_user');
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setRole($link, string $email): void
    {
        $this->role = $this->fetchUserAttribute($link, $email, 'role');
    }
    
    public function getRole(): ?string
    {
        return $this->role;
    }
    
    public function loginUser($link, string $email, string $password): bool
    {
        try {
            $passHash = $this->fetchUserAttribute($link, $email, 'password');
            if ($passHash && password_verify($password, $passHash)) {
                $this->setName($link, $email);
                $this->setId($link, $email);
                $this->setRole($link, $email);
                    
                return true;
            }
            return false;
        } catch (Exception $e) {
            error_log($e->getMessage());
            
            echo '<script type="text/javascript">',
            'showModal("An error occurred. Please try again later.");',
            '</script>';
            
            return false;
        }
    }
    

    public function regUser($link, string $email, string $password, string $name): bool
    {   
        try {
            if ($this->fetchUserAttribute($link, $email, 'email')) {
                echo '<script>showModal("User exists with this email");</script>';
                return false;
            }
            
            $hash_pass = $this->hash_pass_user($password);
            $query = "INSERT INTO user(email, password, name) VALUES (?, ?, ?)";
            $stmt = $this->executeQuery($link, $query, 'sss', $email, $hash_pass, $name);  
            mysqli_stmt_close($stmt);
            
            $this->setName($link, $email);
            $this->setId($link, $email);
            $this->setRole($link, $email);
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
           
            echo '<script type="text/javascript">',
            'showModal("An error occurred. Please try again later.");',
            '</script>';
            
            return false;
        }
    }
    
    public function viewUser($link, int $id_user) : array 
    {
        try{            
            $query = "SELECT * FROM user WHERE id_user = ?";
            $stmt = $this->executeQuery($link, $query, 'i', $id_user);
            $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
            mysqli_stmt_close($stmt);
            
            return $user ?? [];
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
                
            return [];
        }
    }
    
    public function viewedMovieByUser($link, int $id_user) : array
    {
        try{
            $query = "SELECT * FROM rate_user_movie WHERE id_user = ?";
            $stmt = $this->executeQuery($link, $query, 'i', $id_user);
            $movies = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
            mysqli_stmt_close($stmt);
            
            return $movies ?? [];
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            return [];
        }
    }
    
    public function countStatusMovie($link, int $id_user, string $status) : ?int
    {
        try{    
            $total_status = 0;
            
            $query = "SELECT COUNT(*) as total_status FROM rate_user_movie WHERE id_user = ? AND status = ?";
            $stmt = $this->executeQuery($link, $query, 'is', $id_user, $status);
            mysqli_stmt_bind_result($stmt, $total_status);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
            
            return $total_status;
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
                
            return 0;
        }
    }
    
    public function updateName($link, int $id_user, string $newName) : bool
    {
        try {            
            $query = "UPDATE user SET name = ? WHERE id_user = ?";
            $stmt = $this->executeQuery($link, $query, 'si', $newName, $id_user);
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            return false;
        }
    }
    
    public function updatePass($link, int $id_user, string $newPass, string $oldPass) : bool
    {
        try {
            $query = "SELECT password FROM user WHERE id_user = ?";
            $stmt = $this->executeQuery($link, $query, 'i', $id_user);
            $result = mysqli_stmt_get_result($stmt);
            
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $passHash = $row['password'];
                mysqli_stmt_close($stmt);
                
                if (password_verify($oldPass, $passHash)) {
                    $hash_pass = $this->hash_pass_user($newPass);
                    $query = "UPDATE user SET password = ? WHERE id_user = ?";
                    $stmt = $this->executeQuery($link, $query, 'si', $hash_pass, $id_user);
                    mysqli_stmt_close($stmt);
                    
                    return true;
                }
            }
            return false;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            
            if(isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }
    
    public function updatePhoto($link, int $id_user, string $path, string $photo) : bool
    {
        try {
            $query = "UPDATE user SET path = ?, photo = ? WHERE id_user = ?";
            $stmt = $this->executeQuery($link, $query, 'ssi', $path, $photo);
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);

            return false;
        }
    }
}

