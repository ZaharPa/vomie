<?php
namespace scripts\class;

use Exception;
use scripts\interface\User;

class Viewer implements User
{
    private $name;
    private $role;
    private $id;
    

    public function setName( $link, string $email): void    
    {
        $query = "SELECT name FROM user WHERE email = ?";
        $stmt = mysqli_prepare($link, $query);
        
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($result);
        
        if ($row)
            $this->name = $row['name'];
        else $this->name = null;
            
        mysqli_stmt_close($stmt);
    }

    public function getName(): ?string
    {
        return $this->name;
    }
    
    public function setId( $link, string $email): void
    {
        $query = "SELECT id_user FROM user WHERE email = ?";
        $stmt = mysqli_prepare($link, $query);
        
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($result);
        
        if ($row)
            $this->id = $row['id_user'];
            else $this->id = null;
            
            mysqli_stmt_close($stmt);
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function setRole($link, string $email): void
    {
        $query = "SELECT role FROM user WHERE email = ?";
        $stmt = mysqli_prepare($link, $query);
        
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_array($result);
        
        if ($row)
            $this->role = $row['role'];
        else $this->role = null;
        
        mysqli_stmt_close($stmt);
    }
    
    public function getRole(): ?string
    {
        return $this->role;
    }
    
    public function loginUser($link, string $email, string $password): bool
    {
        try {
            $stmt = mysqli_prepare($link, "SELECT password FROM user WHERE email = ?");
            if (!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
            
            if (!$result) {
                throw new Exception("Error compiling query: " . mysqli_error($link));
            }
            
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $passHash = $row['password'];
                
                if (password_verify($password, $passHash)) {
                    $this->setName($link, $email);
                    $this->setId($link, $email);
                    $this->setRole($link, $email);
                    
                    mysqli_stmt_close($stmt);
                    
                    return true;
                } else {
                    mysqli_stmt_close($stmt);
                    
                    return false;
                }
            }
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
    
    private function hash_pass_user($password) :string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    public function regUser($link, string $email, string $password, string $name): bool
    {   
        try {
            $stmt_check = mysqli_prepare($link, "SELECT * FROM user WHERE email = ?");
            if (!$stmt_check) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            mysqli_stmt_bind_param($stmt_check, 's', $email);
            mysqli_stmt_execute($stmt_check);
            $result_check = mysqli_stmt_get_result($stmt_check);
            
            if (!$result_check) {
                throw new Exception("Error compiling query: " . mysqli_error($link));
            }
            
            if (mysqli_num_rows($result_check) < 1) {
                $hash_pass = $this->hash_pass_user($password);
                
                $stmt_insert = mysqli_prepare($link, "INSERT INTO user(email, password, name) VALUES (?, ?, ?)");
                
                if (!$stmt_insert) {
                    throw new Exception("Error prepere query: " . mysqli_error($link));
                }
                
                mysqli_stmt_bind_param($stmt_insert, 'sss', $email, $hash_pass, $name);
                $result_insert = mysqli_stmt_execute($stmt_insert);
                
                if (!$result_insert) {
                    throw new Exception("Error compiling query: " . mysqli_error($link));
                }
                
                $this->setName($link, $email);
                $this->setId($link, $email);
                $this->setRole($link, $email);
                
                mysqli_stmt_close($stmt_check);
                mysqli_stmt_close($stmt_insert);
                return true;
            } else {
                echo '<script type="text/javascript">',
                'showModal("User exist with this email");',
                '</script>';
                mysqli_stmt_close($stmt_check);
                return false;
            }

        } catch (Exception $e) {
            error_log($e->getMessage());
            echo '<script type="text/javascript">',
            'showModal("An error occurred. Please try again later.");',
            '</script>';
            
            if ($stmt_check) {
                mysqli_stmt_close($stmt_check);
            }
            if (isset($stmt_insert) && $stmt_insert) {
                mysqli_stmt_close($stmt_insert);
            }
            return false;
        }
    }
    
    public function viewUser($link, int $id_user) : array 
    {
        try{            
            $query = "SELECT * FROM user WHERE id_user = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'i', $id_user)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($result) === 0) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            }
            
            $user = mysqli_fetch_assoc($result);
            
            mysqli_stmt_close($stmt);
            
            return $user;
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            if(isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
                
                return [];
        }
    }
    
    public function viewedMovieByUser($link, int $id_user) : array
    {
        try{
            $query = "SELECT * FROM rate_user_movie WHERE id_user = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'i', $id_user)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            
            $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($result) === 0) {
                throw new Exception("Error " . mysqli_stmt_error($stmt));
            }
            
            $usersMovie = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            mysqli_stmt_close($stmt);
            
            return $usersMovie;
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            if(isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
                
                return [];
        }
    }
    
    public function countStatusMovie($link, int $id_user, string $status) : ?int
    {
        try{    
            $total_status = 0;
            
            $query = "SELECT COUNT(*) as total_status FROM rate_user_movie WHERE id_user = ? AND status = ?";
            $stmt = mysqli_prepare($link, $query);
            
            if(!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if(!mysqli_stmt_bind_param($stmt, 'is', $id_user, $status)) {
                throw new Exception("Error binding parameters: " . mysqli_stmt_error($stmt));
            }
            
            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
            }
            
            mysqli_stmt_bind_result($stmt, $total_status);
            mysqli_stmt_fetch($stmt);
            
            mysqli_stmt_close($stmt);
            
            return $total_status;
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            if(isset($stmt) && $stmt !== false)
                mysqli_stmt_close($stmt);
                
                return 0;
        }
    }
    
    public function updateName($link, int $id_user, string $newName) : bool
    {
        try {            
            $query = "UPDATE user SET name = ? WHERE id_user = ?";
            
            $stmt = mysqli_prepare($link, $query);
            
            if ($stmt === false) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if (!mysqli_stmt_bind_param($stmt, 'si', $newName, $id_user)) {
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
    
    public function updatePass($link, int $id_user, string $newPass, string $oldPass) : bool
    {
        try {
            $query = "SELECT password FROM user WHERE id_user = ?";
            $stmt = mysqli_prepare($link, $query);
            if (!$stmt) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            mysqli_stmt_bind_param($stmt, 'i', $id_user);
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
            
            if (!$result) {
                throw new Exception("Error compiling query: " . mysqli_error($link));
            }
            
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $passHash = $row['password'];
                
                if (password_verify($oldPass, $passHash)) {
                    
                    $hash_pass = $this->hash_pass_user($newPass);
                    
                    $query = "UPDATE user SET password = ? WHERE id_user = ?";
                    
                    $stmt = mysqli_prepare($link, $query);
                    
                    if ($stmt === false) {
                        throw new Exception("Error prepare query: " . mysqli_error($link));
                    }
                    
                    if (!mysqli_stmt_bind_param($stmt, 'si', $hash_pass, $id_user)) {
                        throw new Exception("Error prepare parameters: " . mysqli_stmt_error($stmt));
                    }
                    
                    $result = mysqli_stmt_execute($stmt);
                    
                    if ($result === false) {
                        throw new Exception("Error executing query: " . mysqli_stmt_error($stmt));
                    }
                    
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
            
            $stmt = mysqli_prepare($link, $query);
            
            if ($stmt === false) {
                throw new Exception("Error prepare query: " . mysqli_error($link));
            }
            
            if (!mysqli_stmt_bind_param($stmt, 'ssi', $path, $photo, $id_user)) {
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
    
    public function deleteUser($link, string $email) : bool
    {}
}

