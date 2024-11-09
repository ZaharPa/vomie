<?php
namespace scripts\class;

use Exception;
use scripts\interface\MovieDetailInterface;

class MovieDetail implements MovieDetailInterface
{
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
    
    public function addGenre($link, $id_movie, $genre) : bool
    {
        try {
            $query = "INSERT INTO genre_movie(id_movie, genre) VALUES (?, ?)";
            $stmt = $this->executeQuery($link, $query, 'is', $id_movie, $genre);
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
           
            echo '<script type="text/javascript">',
            'showModal("An error occurred with genre. Please try again later.");',
            '</script>';
            
            return false;
        }
    }
    
    public function editGenre($link, $id_movie, $genre): bool
    {
        $link->begin_transaction();
        
        try {
            $existing_genres = [];
            
            $select_query = "SELECT genre FROM genre_movie WHERE id_movie = ?";
            $stmt = $this->executeQuery($link, $select_query, 'i', $id_movie);
            
            $result = mysqli_stmt_get_result($stmt);
            
            if (!$result) {
                throw new Exception("Error result: " . mysqli_stmt_error($stmt));
            }

            while ($row = mysqli_fetch_assoc($result)) {
                $existing_genres[] = $row['genre'];
            }
            mysqli_stmt_close($stmt);
            
            $genres_to_add = array_diff($genre, $existing_genres);
            $genres_to_remove = array_diff($existing_genres, $genre);
            
            if (!empty($genres_to_remove)) {
                $delete_query = "DELETE FROM genre_movie WHERE id_movie = ? AND genre = ?";
                
                foreach($genres_to_remove as $genre_to_remove) {
                    $this->executeQuery($link, $delete_query, 'is', $id_movie, $genre_to_remove);
                }
                
                mysqli_stmt_close($stmt);
            }
            
            if (!empty($genres_to_add)) {
                foreach($genres_to_add as $genre_to_add) {
                    $this->addGenre($link, $id_movie, $genre_to_add);
                }
            }
            
            $link->commit();
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Edit genre ");
            echo '<script type="text/javascript">',
            'showModal("An error occurred with genre. Please try again later.");',
            '</script>';
            
            $link->rollback();
            return false;
        }
    }
    
    public function deleteGenre($link, $id_movie) : bool
    {
        try {
            $id_movie = (int)$id_movie;
            
            $query = "DELETE  FROM genre_movie WHERE id_movie = ?";
            $stmt = $this->executeQuery($link, $query, 'i', $id_movie);
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);

            return false;
        }
    }
    
    public function addPhoto($link, $id_movie, $path, $photo) : bool
    {
        try {
            $query = "INSERT INTO photo_movie(id_movie, path, photo) VALUES (?, ?, ?)";
            $stmt = $this->executeQuery($link, $query, 'iss', $id_movie, $path, $photo);
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            echo '<script type="text/javascript">',
            'showModal("An error occurred with photo. Please try again later.");',
            '</script>';
            
            return false;
        }
    }
    
    public function editPhoto($link, $id_movie, $photos, $titleMovie) : bool
    {
        $link->begin_transaction();
        
        try {
            $existing_photos = isset($_POST['existing_photos']) ? $_POST['existing_photos'] : [];
            $delete_photos = isset($_POST['delete_photos']) ? $_POST['delete_photos'] : [];
            
            foreach ($existing_photos as $i => $photo) {
                if (isset($delete_photos[$i]) && $delete_photos[$i] === '1') {
                    $delete_query = "DELETE FROM photo_movie WHERE id_movie = ? AND photo = ?";
                    $stmt = $this->executeQuery($link, $delete_query, 'is', $id_movie, $photo);
                    mysqli_stmt_close($stmt);
                    
                    $path = 'images/moviePhoto/' . $photo;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }
            
            $totalFiles = count($photos['name']);
            for ($i = 0; $i < $totalFiles; $i++) {
                if ($photos["error"][$i] == UPLOAD_ERR_OK) {
                    $fileMime = mime_content_type($photos["tmp_name"][$i]);
                    $allowedMime = ['image/jpeg', 'image/png'];
                    
                    if (in_array($fileMime, $allowedMime)) {
                        $fileExtension = ($fileMime === 'image/jpeg') ? 'jpg' : 'png';
                        $newFileName = $id_movie . '_' . $titleMovie  . '_' . $i . '.' . $fileExtension;
                        $path = 'images/moviePhoto/';
                        
                        if (in_array($newFileName, array_column($existing_photos, 'photo'))) {
                            $delete_query = "DELETE FROM photo_movie WHERE id_movie = ? AND photo = ?";
                            $stmt = $this->executeQuery($link, $delete_query, 'is', $id_movie, $newFileName);
                            mysqli_stmt_close($stmt);
                            
                            if (file_exists($path . $newFileName)) {
                                unlink($path . $newFileName);
                            }
                        }
                        
                        $this->addPhoto($link, $id_movie, $path, $newFileName);
                        move_uploaded_file($photos["tmp_name"][$i], $path . $newFileName);
                    } else {
                        throw new Exception("Invalid file type");
                    }
                }
            }
            
            $link->commit();
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Edit photo");
            $link->rollback();
            return false;
        }
    }
    
    
    public function deletePhoto($link, $id_movie) : bool
    {
        try {
            $id_movie = (int)$id_movie;
            
            $query = "DELETE FROM photo_movie WHERE id_movie = ?";
            $stmt = $this->executeQuery($link, $query, 'i', $id_movie);
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            return false;
        }
    }
    
    public function addCast($link, $id_movie, $name, $role, $path = null, $photo = null) : bool
    {
        try {
            if ($photo != null) {
                $query = "INSERT INTO cast_movie(id_movie, name, role, path, photo) VALUES (?, ?, ?, ?, ?)";
                $stmt = $this->executeQuery($link, $query, 'issss', $id_movie, $name, $role, $path, $photo);
            } else {
                $query = "INSERT INTO cast_movie(id_movie, name, role) VALUES (?, ?, ?)";
                $stmt = $this->executeQuery($link, $query, 'iss', $id_movie, $name, $role);
            }
            
            mysqli_stmt_close($stmt);
                    
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            echo '<script type="text/javascript">',
            'showModal("An error occurred with cast. Please try again later.");',
            '</script>';
            
            return false;
        }
    }
    
    public function editCast($link, $id_movie, $id_cast, $name, $role, $photo) : bool
    {
        try {
            $delete_cast = isset($_POST['delete_cast']) ? $_POST['delete_cast'] : [];
            
            if (!empty($delete_cast)) {
                var_dump($delete_cast);
                foreach ($delete_cast as $id => $cast) {
                    if (isset($cast) && $cast === '1') {
                        $delete_query = "DELETE FROM cast_movie WHERE id_movie = ? AND id_cast_staff = ?";
                        
                        $stmt = $this->executeQuery($link, $delete_query, 'іi', $id_movie, $id);
                        
                        mysqli_stmt_close($stmt);
                        
                        $path = 'images/castPhoto/';
                        
                        if (file_exists($path . $photo)) {
                            unlink($path . $photo);
                        }
                    }
                }
            }
            
            $id_cast = (int)$id_cast;
            
            $query = "UPDATE cast_movie SET name = ?, role = ? WHERE id_cast_staff = ?";
            $stmt = $this->executeQuery($link, $query, 'ssi', $name, $role, $id_cast);
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query edit Cast");
            
            if (isset($stmt) && $stmt !== false) {
                mysqli_stmt_close($stmt);
            }
            
            return false;
        }
    }
    
    public function deleteCast($link, $id_movie) : bool
    {
        try {
            $id_movie = (int)$id_movie;
            
            $query = "DELETE FROM cast_movie WHERE id_movie = ?";
            $stmt = $this->executeQuery($link, $query, 'i', $id_movie);
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            return false;
        }
    }
    
    public function addLink($link, $id_movie, $name, $link_movie) : bool
    {
        try {
            $query = "INSERT INTO link_movie(id_movie, name, link) VALUES (?, ?, ?)";
            $stmt = $this->executeQuery($link, $query, 'iss', $id_movie, $name, $link_movie);
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . " Query: " . $query);
            
            echo '<script type="text/javascript">',
            'showModal("An error occurred with link. Please try again later.");',
            '</script>';
            
            return false;
        }
    }
    
    public function editLink($link, $id_link, $name, $link_movie) : bool
    {
        try {
            $delete_link = isset ($_POST['delete_link']) ? $_POST['delete_link'] : [];
            
            if (!empty($delete_link)) {
                foreach ($delete_link as $id => $link_delete) {
                    if (isset($link_delete) && $link_delete === '1') {
                        $delete_query = "DELETE FROM link_movie WHERE id_movie = ? AND id_link = ?";
                        $stmt = $this->executeQuery($link, $delete_query, 'ii', $_GET['id'], $id);
                        mysqli_stmt_close($stmt);
                    }
                }
            }
            if (!empty($id_link)) {
                $id_link = (int)$id_link;
                
                $query = "UPDATE link_movie SET name = ?, link = ? WHERE id_link = ?";
                $stmt = $this->executeQuery($link, $query, 'ssi', $name, $link, $id_link);
                mysqli_stmt_close($stmt);
                
                return true;
            } else {
                $this->addLink($link, $_GET['id'], $name, $link_movie);
                return true;
            }
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query edit link: " . $query);
            
            return false;
        }
    }
    
    public function deleteLink($link, $id_movie) : bool
    {
        try {
            $id_movie = (int)$id_movie;
            
            $query = "DELETE FROM link_movie WHERE id_movie = ?";
            $stmt = $this->executeQuery($link, $query, 'i', $id_movie);
            mysqli_stmt_close($stmt);
            
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage() . "Query: " . $query);
            
            return false;
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
    
    public function viewGenreForMovie($link, $id_movie) : array
    {
        try {
            $query = "SELECT genre FROM genre_movie  WHERE id_movie = ?";
            $stmt = $this->executeQuery($link, $query, 'i', $id_movie);
            $result = mysqli_stmt_get_result($stmt);
            
            $movieGenre = [];
            
            while ($row = mysqli_fetch_assoc($result)) {
                $movieGenre[] = $row;
            }
            
            mysqli_stmt_close($stmt);
            
            return $movieGenre;
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query" . $query);

            return [];
        }
    }
    
    public function viewLinkForMovie($link, $id_movie) : array
    {
        try {
            $query = "SELECT id_link, name, link FROM link_movie WHERE id_movie = ?";
            $stmt = $this->executeQuery($link, $query, 'i', $id_movie);
            $result = mysqli_stmt_get_result($stmt);
            
            $movielink = [];
            
            while ($row = mysqli_fetch_assoc($result)) {
                $movielink[] = $row;
            }
            
            mysqli_stmt_close($stmt);
            
            return $movielink;     
        } catch(Exception $e) {
            error_log($e->getMessage() . "Query" . $query);
                
            return [];
        }
    }
    
    public function viewPhotoForMovie($link, $id_movie) : array
    {
        try {
            $query = "SELECT path, photo FROM photo_movie  WHERE id_movie = ?";
            $stmt = $this->executeQuery($link, $query, 'i', $id_movie);
            $result = mysqli_stmt_get_result($stmt);
            
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
            $query = "SELECT id_cast_staff, name, role, path, photo FROM cast_movie  WHERE id_movie = ?";
            $stmt = $this->executeQuery($link, $query, 'i', $id_movie);
            $result = mysqli_stmt_get_result($stmt);
            
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

