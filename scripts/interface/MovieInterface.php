<?php
namespace scripts\interface;

interface MovieInterface
{
    public function addMovie($link, string $name, string $date, string $description, string $status, string $type, string $duration) : bool;
    public function editMovie($link, int $id, string $name, string $date, string $description, string $status, string $type, string $duration) : bool;
    public function deleteMovie($link, int $id) : bool;
    
    public function setIdMovie(int $id) : void;
    public function getIdMovie() : ?string;
    
    public function viewsAllMovie($link) : array;    
    public function viewOneMovie($link, int $id) : array;
    
    public function viewMovieForSlider($link) : array;
    public function viewMovieByGenre($link, string $genre) : array;
}

