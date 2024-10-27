<?php
use scripts\class\Viewer;
use scripts\Database;

$curUser = new Viewer();
$link = Database::getLink();
$id_user = $_SESSION['id_user'];

$user = $curUser->viewUser($link, $id_user);
$imgUser = $user['path'] . $user['photo'];
$userMovies = $curUser->viewUsersMovie($link, $id_user);
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
	<div class="middle-section">
		<h3>Yours movie</h3>
		<div class="users-movie">
			<?php foreach ($userMovies as $movie) {
			var_dump($movie);?>
			
			<?php }?>
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