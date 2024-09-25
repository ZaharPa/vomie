<?php
namespace scripts\interface;

interface Entartaiment
{
    public function addMovie($link, $name, $date, $description, $status, $type, $duration) : bool;
    public function editMovie($link, $id, $name, $date, $description, $status, $type, $duration) : bool;
    public function deleteMovie($link, $id) : bool;
    
    public function addGenre($link, $id_movie, $genre) : bool;
    public function editGenre($link, $id_genre, $id_movie, $genre) : bool;
    public function deleteGenre($link, $id_genre) : bool;
    
    public function addPhoto($link, $id_movie, $path, $photo) : bool;
    public function editPhoto($link, $id_photo, $id_movie, $path, $photo) : bool;
    public function deletePhoto($link, $id_photo) : bool;
    
    public function addCast($link, $id_movie, $name, $role, $path = null, $photo = null) : bool;
    public function editCast($link, $id_cast, $id_movie, $name, $role, $path, $photo) : bool;
    public function deleteCast($link, $id_cast) : bool;
    
    public function addLink($link, $id_movie, $name, $link_movie) : bool;
    public function editLink($link, $id_link, $id_movie, $link_movie) : bool;
    public function deleteLink($link, $id_link) : bool;
    
    public function setIdMovie($id) : void;
    public function getIdMovie() : ?string;
    
    public function viewsAllMovie($link) : array;
    public function viewOneMovie($link, $id) : array;
    public function viewPhotosMovie($link) : array;
}
