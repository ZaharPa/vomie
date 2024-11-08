<?php
    use scripts\Database;
    use scripts\class\Movie;
    
    $link = Database::getLink();
    $curMovie = new Movie();
    
    $movieSlider = $curMovie->viewMovieForSlider($link);
?>

<section class="home-section">
	<h2>Last movie</h2>
	<div class="slider">
    	<button class="prev-btn">&#10094;</button>
    	<div class="slider-content">
    		<?php foreach ($movieSlider as $movie) {
    		    $moviePhoto = $curMovie->viewPhotoForMovie($link, $movie['id_movie']);
    		    $firstPhoto = isset($moviePhoto[1]) ? $moviePhoto[1] : $moviePhoto[0];
    		    $imgSrc = $firstPhoto['path'] . $firstPhoto['photo'];
    		    ?>
    			<div class="slide" style="background-image: url('<?=$imgSrc?>');">
    				<div class="slide-text">
            			<h2 class="movie-title"><?=$movie['name']?></h2>
            			<span class="movie-rate">Rate - <?=$movie['avg_rate']?></span>
            			<p class="movie-description"><?=$movie['description']?></p>
        			</div>
    			</div>
    		<?php }?>
    	</div>
    	<button class="next-btn">&#10095;</button>
	</div>
	
	<h3>Drama</h3>
	<div class="genre">
		<?php 
		    $moviesGenre = $curMovie->viewMovieByGenre($link, 'drama');
		    foreach ($moviesGenre as $movie) {
		        $moviePhoto = $curMovie->viewPhotoForMovie($link, $movie['id_movie']);
		        $firstPhoto = $moviePhoto[0];
		        $imgSrc = $firstPhoto['path'] . $firstPhoto['photo'];
		?>
				<div class="movie-card">
         			<a href="index.php?page=movieDetail&id=<?=$movie['id_movie']?>">
         				<img src='<?=$imgSrc?>' alt="Name movie">
         			</a>
         			<p><?=htmlspecialchars($movie['name'])?></p>
         		</div>
		<?php } ?>
	</div>
	
	<h3>Romance</h3>
	<div class="genre">
		<?php 
		    $moviesGenre = $curMovie->viewMovieByGenre($link, 'romance');
		    foreach ($moviesGenre as $movie) {
		        $moviePhoto = $curMovie->viewPhotoForMovie($link, $movie['id_movie']);
		        $firstPhoto = $moviePhoto[0];
		        $imgSrc = $firstPhoto['path'] . $firstPhoto['photo'];
		?>
				<div class="movie-card">
         			<a href="index.php?page=movieDetail&id=<?=$movie['id_movie']?>">
         				<img src='<?=$imgSrc?>' alt="Name movie">
         			</a>
         			<p><?=htmlspecialchars($movie['name'])?></p>
         		</div>
		<?php } ?>
	</div>
</section>

<script src="scripts/JavaScript/sliderMovie.js"></script>
