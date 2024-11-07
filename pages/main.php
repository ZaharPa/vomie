<?php
    use scripts\Database;
    use scripts\class\Movie;
    
    $link = Database::getLink();
    $curMovie = new Movie();
    
    $movieSlider = $curMovie->viewMovieForSlider($link);
?>

<section class="home-section">
	<button class="prev-btn">&#10094;</button>
	<div class="slider-content">
		<?php foreach ($movieSlider as $movie) {?>
			<h2 class="movie-title"><?=$movie['name']?></h2>
			<span class="movie-rate"><?=$movie['avg_rate']?></span>
			<p class="movie-description"><?=$movie['description']?></p>
		<?php }?>
	</div>
	<button class="next-btn">&#10095;</button>
</section>
