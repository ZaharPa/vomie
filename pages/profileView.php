<?php
use scripts\class\Viewer;
use scripts\Database;
use scripts\class\Movie;

$curUser = new Viewer();
$curMovie = new Movie();
$link = Database::getLink();
$id_user = $_SESSION['id_user'];

$user = $curUser->viewUser($link, $id_user);
$imgUser = $user['path'] . $user['photo'];
$userMovies = $curUser->viewedMovieByUser($link, $id_user);
?>

<section class="profile-view">
	<div class="left-column">
		<img src="<?=$imgUser?>" class="user-photo">
		<h4><?=$user['name']?></h4>
		<p>
			<a href="#">Change Name</a>
			<br>
			<a href="#">Change Photo</a>
			<br>
			<a href="#">Change Password</a>
		</p>
	</div>
	<div class="middle-column">
		<h3>Yours movie</h3>
		<div class="users-movie">
			<?php foreach ($userMovies as $usersMovie) { 
			    $movie = $curMovie->viewOneMovie($link, $usersMovie['id_movie']);
			    $moviePhoto = $curMovie->viewPhotoForMovie($link, $usersMovie['id_movie']);
			    $firstPhoto = $moviePhoto[0];
			    $imgSrc = $firstPhoto['path'] . $firstPhoto['photo'];
			?>
				<div class="movie">
					<img src="<?=$imgSrc?>" class="moviePhoto">
					<span><?=$movie['name']?></span>
					<span><?=$movie['type']?></span>
					<span><?=$usersMovie['status']?></span>
					<span><?=$usersMovie['rate']?></span>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="right-column">
		<div class="black-back">
			<h4>Statistic</h4>
			<p>watching - <?php ?></p>
			<p>completed - <?php ?></p>
			<p>postponed - <?php ?></p>
			<p>abonded - <?php ?></p>
		</div>
		
		<div class="black-back">
			<h4>Sort</h4>
			<button>rate</button>
			<button>year</button>
			<button>genre</button>
			<button>type</button>
		</div>
	</div>
</section>