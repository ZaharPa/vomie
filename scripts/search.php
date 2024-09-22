<?php
use scripts\Database;
use scripts\class\Movie;

require '../vendor/autoload.php';

header('Content-Type: application/json');

$link = Database::getLink();

if (isset($_GET['query'])) {
    $query =  $link->real_escape_string($_GET['query']);
    
    $sql = "SELECT id_movie, name, YEAR(date) as date FROM movie WHERE name LIKE '%$query%'";
    $result = $link->query($sql);
    
    $searchMovies = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $searchMovies[] = $row;
        }
    }
    
    echo json_encode($searchMovies);
} else {
    $curMovie = new Movie();
    $searchMovies = $curMovie->viewsAllMovie($link);
}

$link->close();