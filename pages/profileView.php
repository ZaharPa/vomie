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

<input type="hidden" name="id_user" id="id_user" value="<?=$id_user?>">

<section class="profile-view">
	<div class="left-column">
		<img src="<?=$imgUser?>" class="user-photo">
		<h4><?=$user['name']?></h4>
		<button id="changeName">Change Name</button>
		<button id="changePhoto">Change Photo</button>
		<button id="changePass">Change Password</button>
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
			<?php var_dump($userMovies);?>
		
	</div>
	<div class="right-column">
		<div class="black-back">
			<h4>Statistic</h4>
			<p>watching - <?=$curUser->countStatusMovie($link, $id_user, 'Watching')?></p>
			<p>completed - <?=$curUser->countStatusMovie($link, $id_user, 'Completed')?></p>
			<p>postponed - <?=$curUser->countStatusMovie($link, $id_user, 'Postponed')?></p>
			<p>abonded - <?=$curUser->countStatusMovie($link, $id_user, 'Abonded')?></p>
		</div>
		
		<div class="black-back">
            <h3>Sort</h3>
            <button class="rate-btn">Rate</button>
            
			<div class="filter-section" data-filter="status">
                <h4>Status</h4>
                <div class="filter-options">
                    <span class="filter-option" data-type="Watching">Watching</span>
                    <span class="filter-option" data-type="Completed">Completed</span>
                    <span class="filter-option" data-type="Postponed">Postponed</span>
                    <span class="filter-option" data-type="Abonded">Abonded</span>
                </div>
            </div>
            
			<div class="filter-section" data-filter="type">
                <h4>Type</h4>
                <div class="filter-options">
                    <span class="filter-option" data-type="movie">movie</span>
                    <span class="filter-option" data-type="serial">serial</span>
                    <span class="filter-option" data-type="cartoon movie">cartoon movie</span>
                    <span class="filter-option" data-type="cartoon serials">cartoon series</span>
                    <span class="filter-option" data-type="anime">anime</span>
                </div>
            </div>
            
            <div class="filter-section year-slider">
                <h4>Year</h4>
                <div id="slider"></div>
                <div class="year-values">
                    <input type="number" id="year-min" value="1900" readonly>
                    <input type="number" id="year-max" value="2025" readonly>
                </div>
            </div>
            
            <div class="filter-section">
                <button id="clear-filters">Clear</button>
            </div>
        </div>
	</div>
</section>

<div id="nameModal" class="modal">
	<div class="modal-content user-change">
		<span class="close">&times;</span>
		<h2>Change Name</h2>
		<input type="text" id="newName" placeholder="Enter new name">
		<br>
		<button id="submitName">Edit</button>
	</div>
</div>

<div id="passModal" class="modal">
	<div class="modal-content user-change pass">
		<span class="close">&times;</span>
		<h2>Change Password</h2>
		<p>
    		<label for="oldPass">Old password</label>
    		<input type="text" id="oldPass" name="oldPass">
		</p>
		<p>
    		<label for="newPass">New password</label>
    		<input type="text" id="newPass" name="newPass">
		</p>
		<button id="submitPass">Edit</button>
	</div>
</div>

<div id="photoModal" class="modal">
	<div class="modal-content user-change photo">
		<span class="close">&times;</span>
		<h2>Change Photo</h2>
		<div class="upload-container">
        	<label for="file-input-user" class="file-upload-label">
            	<input type="file" class="file-input" name="photoUser" id="file-input-user" accept="image/*" required />
                <img id="preview-user" src="styles/black-plus.png" alt="Upload Image" />
            </label>
   		</div>
		<button id="submitPhoto">Edit</button>
	</div>
</div>

<script src="scripts/JavaScript/previewPhoto.js"></script>
<script src="scripts/JavaScript/filterOptions.js"></script>
<script src="scripts/JavaScript/slider.js"></script>
<script src="scripts/JavaScript/filterUser.js"></script>
<script src="scripts/JavaScript/changeDataUser.js"></script>