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
        $movieGenre = $curMovie->viewGenreForMovie($link, $id);;
        $movieLink = $curMovie->viewLinkForMovie($link, $id);
        $moviePhoto = $curMovie->viewPhotoForMovie($link, $id);;
        $movieCast = $curMovie->viewCastForMovie($link, $id);
        $firstPhoto = $moviePhoto[0];
        $imgSrc = $firstPhoto['path'] . $firstPhoto['photo'];
?>


    <div class="movie-view">
    	<div class="movie-header">
    		<img src="<?=$imgSrc?>" class="poster">
    		<div class="movie-info">
    			<h1><?=$movie['name']?></h1>
    				<p>
    			<?=$movie['date'] . ' '?>
    			<?=$movie['duration']?>
    			</p>
    			<p class="genre">
    				<?php foreach ($movieGenre as $genre) {
    				    echo $genre["genre"] . " ";
    				} ?>
    			</p> 
    			<p><?=$movie['status'] . ' '?>
    			<?=$movie['type']?></p>
    			<p class="description">
    			<?=$movie['description']?>
    			</p>
    		
    		</div>
    	</div>
    	
    	<div class="photos-movie">
    		<?php foreach ($moviePhoto as $photo) {
    		    $imgSrc = $photo['path'] . $photo['photo'];
    			?>
    			<img src="<?=$imgSrc?>" class="photos">
    		<?php }?>
    	</div>
    	
    	<div class="cast-movie">
    		<?php foreach ($movieCast as $cast) {
    		    $imgSrc = $cast['path'] . $cast['photo'];
    			?>
    			<div class="caster">
    				<img src="<?=$imgSrc?>" class="photos">
    				<p><?=$cast['name']?></p>
    			</div>
    		<?php }?>
    	</div>
    	
    	<div class="link">
    		<?php foreach ($movieLink as $link) {?>
    			<p><?='Name: ' . $link['name']. ' Title: ' . $link['link']?></p>
    		<?php }?>
    	</div>
    </div>
<?php 
    }
}
?>