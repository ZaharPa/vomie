<?php
namespace scripts\interface;

interface MovieDetailInterface
{
    public function addGenre($link, int $id_movie, string $genre) : bool;
    public function editGenre($link, int $id_movie, string $genre) : bool;
    public function deleteGenre($link, int $id_movie) : bool;
    
    public function addPhoto($link, int $id_movie, string $path, string $photo) : bool;
    public function editPhoto($link, int $id_movie, string $photos, string $titleMovie) : bool;
    public function deletePhoto($link, int $id_movie) : bool;
    
    public function addCast($link, int $id_movie, string $name, string $role, string $path = null, string $photo = null) : bool;
    public function editCast($link, int $id_movie, $id_cast, string $name, string $role, string $photo) : bool;
    public function deleteCast($link, int $id_movie) : bool;
    
    public function addLink($link, int $id_movie, string $name, string $link_movie) : bool;
    public function editLink($link, int $id_link, string $name, string $link_movie) : bool;
    public function deleteLink($link, int $id_movie) : bool;
    
    public function viewPhotosMovie($link) : array;
    public function viewGenreForMovie($link, int $id) : array;
    public function viewLinkForMovie($link, int $id) : array;
    public function viewPhotoForMovie($link, int $id) : array;
    public function viewCastForMovie($link, int $id) : array;
}

