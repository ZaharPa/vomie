<?php
use scripts\Database;
use scripts\class\Movie;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $link = Database::getLink();
    $curMovie = new Movie();
    $movie = $curMovie->viewOneMovie($link, $id);

    if (isset($movie['id_movie'])) {
        
?>


<div class="movie-view">
<?=$movie['id_movie']?>
<?=$movie['name']?>
<?=$movie['date']?>
<?=$movie['description']?>
<?=$movie['status']?>
<?=$movie['type']?>

</div>
<?php 
    }
}
?>