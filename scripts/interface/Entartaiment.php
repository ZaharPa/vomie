<?php
namespace scripts\interface;

interface Entartaiment
{
    public function addMovie($link, $name, $date, $description, $status, $type, $duration) : bool;
    public function editMovie($link, $id, $name, $date, $description, $status, $type, $duration) : bool;
    public function deleteMovie($link, $id) : bool;
    
    public function addGenre($link, $id_movie, $genre) : bool;
    public function editGenre($link, $id_movie, $genre) : bool;
    public function deleteGenre($link, $id_movie) : bool;
    
    public function addPhoto($link, $id_movie, $path, $photo) : bool;
    public function editPhoto($link, $id_movie, $photos, $titleMovie) : bool;
    public function deletePhoto($link, $id_movie) : bool;
    
    public function addCast($link, $id_movie, $name, $role, $path = null, $photo = null) : bool;
    public function editCast($link, $id_movie, $id_cast, $name, $role, $photo) : bool;
    public function deleteCast($link, $id_movie) : bool;
    
    public function addLink($link, $id_movie, $name, $link_movie) : bool;
    public function editLink($link, $id_link, $name, $link_movie) : bool;
    public function deleteLink($link, $id_movie) : bool;
    
    public function setIdMovie($id) : void;
    public function getIdMovie() : ?string;
    
    public function viewsAllMovie($link) : array;
    public function viewPhotosMovie($link) : array;
    
    public function viewOneMovie($link, $id) : array;
    public function viewAddInfoForMovie($link, $id_movie) : array;
    public function viewGenreForMovie($link, $id) : array;
    public function viewLinkForMovie($link, $id) : array;
    public function viewPhotoForMovie($link, $id) : array;
    public function viewCastForMovie($link, $id) : array;
    
    public function viewMovieForSlider($link) : array;
    public function viewMovieByGenre($link, string $genre) : array;
}
