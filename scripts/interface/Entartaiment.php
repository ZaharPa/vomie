<?php
namespace scripts\interface;

interface Entartaiment
{
    public function addMovie($link, $name, $date, $description, $status, $type, $duration);
    public function editMovie($link, $id, $name, $date, $description, $status, $type, $duration);
    public function deleteMovie($link, $id);
    
    public function addGenre($link, $id_movie, $genre);
    public function editGenre($link, $id_genre, $id_movie, $genre);
    public function deleteGenre($link, $id_genre);
    
    public function addPhoto($link, $id_movie, $path, $photo);
    public function editPhoto($link, $id_photo, $id_movie, $path, $photo);
    public function deletePhoto($link, $id_photo);
    
    public function addCast($link, $id_movie, $name, $role, $path, $photo);
    public function editCast($link, $id_cast, $id_movie, $name, $role, $path, $photo);
    public function deleteCast($link, $id_cast);
    
    public function addLink($link, $id_movie, $name, $link_movie);
    public function editLink($link, $id_link, $id_movie, $link_movie);
    public function deleteLink($link, $id_link);
    
    public function viewsAllMovie($link);
    public function viewOneMovie($link, $id);
}
