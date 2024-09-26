<?php
use scripts\Database;
use scripts\class\Movie;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $link = Database::getLink();
    $curMovie = new Movie();
    $movie = $curMovie->viewOneMovie($link, $id);

    if (isset($movie['id_movie'])) {
        $movieAddInfo = $curMovie->viewAddInfoForMovie($link, $id);
        $movieGenre = $curMovie->viewGenreForMovie($link, $id);
        echo 'genre - ';
        var_dump($movieGenre);
        echo "<hr>";
        $movieLink = $curMovie->viewLinkForMovie($link, $id);
        echo 'link - ';
        var_dump($movieLink);
        echo "<hr>";
        $moviePhoto = $curMovie->viewPhotoForMovie($link, $id);
        echo 'photo - ';
        var_dump($moviePhoto);
        echo "<hr>";
        $movieCast = $curMovie->viewCastForMovie($link, $id);
        echo 'cast - ';
        var_dump($movieCast);
        echo "<hr>";
        foreach ($movieAddInfo as $movi) {
            echo "Genre: " . $movi['genre'] . "<br>";
            echo "Link: " . $movi['link'] . "<br>";
            echo "Photo path: " . $movi['movie_path'] . "<br>";
            echo "Movie photo: " . $movi['movie_photo'] . "<br>";
            echo "Cast path: " . $movi['cast_path'] . "<br>";
            echo "Cast photo: " . $movi['cast_photo'] . "<br>";
            echo "<hr>";
        }
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