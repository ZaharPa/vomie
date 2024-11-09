<?php
use scripts\Database;
use scripts\class\Movie;
use scripts\class\FeedBack;
use scripts\class\MovieDetail;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $link = Database::getLink();
    $curMovie = new Movie();
    $curInfoMovie = new MovieDetail();
    $movie = $curMovie->viewOneMovie($link, $id);

    if (isset($movie['id_movie'])) {
        $movieGenre = $curInfoMovie->viewGenreForMovie($link, $id);;
        $movieLink = $curInfoMovie->viewLinkForMovie($link, $id);
        $moviePhoto = $curInfoMovie->viewPhotoForMovie($link, $id);;
        $movieCast = $curInfoMovie->viewCastForMovie($link, $id);
        $firstPhoto = $moviePhoto[0];
        $imgSrc = $firstPhoto['path'] . $firstPhoto['photo'];
        $statusObj = new FeedBack();
        $average_rating = $statusObj->viewAverageRate($link, $id);
        
        
        if (isset($_SESSION['id_user'])) {
            $id_user = $_SESSION['id_user'];
            $status = $statusObj->viewStatus($link, $id, $id_user);
            $rate = $statusObj->viewRate($link, $id, $id_user);
        }
        
        if(isset($_GET['action'])) {
            if ($_GET['action'] === 'delete') {
                $curMovie->deleteMovie($link, $id);
                if (!empty($movieGenre))
                    $curInfoMovie->deleteGenre($link, $id);
                
                if (!empty($movieLink))
                    $curInfoMovie->deleteLink($link, $id);
                
                if (!empty($moviePhoto))
                    $curInfoMovie->deletePhoto($link, $id);
                
                if (!empty($movieCast))
                    $curInfoMovie->deleteCast($link, $id);
                
                header('Location: index.php');
                exit();
            }
        }
        
        
?>

	
        <section class="movie-view">
            <div class="left-column">
                <img src="<?=$imgSrc?>" class="poster">
                <input type="hidden" name="id_movie" id="id_movie" value="<?=$id?>">

                <?php if (isset($_SESSION['id_user'])) {?>
                	<div class="custom-dropdown">
						<div class="selected-option" id="selected-option">Select status</div>
						<div class="dropdown-list" id="dropdown-list">
							<div class="dropdown-item" data-value="Watching">Watching</div>
							<div class="dropdown-item" data-value="Completed">Completed</div>
							<div class="dropdown-item" data-value="Postponed">Postponed</div>
							<div class="dropdown-item" data-value="Abonded">Abonded</div>
							<div class="dropdown-item" data-value="Delete">Delete</div>
						</div> 
                	</div>
                	
                	<form id="statusForm" method="post">
                		<input type="hidden" name="id_user" id="id_user" value="<?=$id_user?>">
                		<input type="hidden" name="status" id="status" value="<?=$status?>">
                	</form>
                	
                	<div class="rating-container">
                		<div class="stars" id="stars">
                			<span class="star" data-value="1">&#9733;</span>
                			<span class="star" data-value="2">&#9733;</span>
                			<span class="star" data-value="3">&#9733;</span>
                			<span class="star" data-value="4">&#9733;</span>
                			<span class="star" data-value="5">&#9733;</span>
                		</div>
                	</div>
                	
                	<a href="#comment-section" class="comment-btn">Comment section</a>
                <?php }?>
                
               	<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'){?>
               		<p class="link-edit">
               			<a href="index.php?page=edit-movie&id=<?=$id?>">Edit Movie</a>
               			<br>
               			<a href="index.php?page=movieDetail&id=<?=$id?>&action=delete">Delete Movie</a>
               		</p>
               	<?php }?>
            </div>
            
            <div class="right-column">
                <div class="movie-header">
                    <h1 class="movie-title"><?=$movie['name']?></h1>
                    <p class="genre">
                        <?php foreach ($movieGenre as $genre) {
                            echo $genre["genre"] . " ";
                        } ?>
                    </p> 
                    <p class="description"><?=$movie['description']?></p>
                </div>
        
                <div class="link-section">
                    <p><strong>Average rating:</strong> <?=$average_rating?></p>
                 	<p><strong>Status movie:</strong> <?=$movie['status']?></p>
                	<p><strong>Type:</strong> <?=$movie['type']?></p>
                    <p><strong>Date release:</strong> <?=$movie['date']?></p>
                    <p><strong>Duration:</strong> <?=$movie['duration']?></p>
                    <strong>Link:</strong>
                    <div class="links">
                        <?php foreach ($movieLink as $link) { ?>
                            <a href="<?=$link['link']?>" target="_blank"><?=$link['name']?></a>
                        <?php } ?>
                    </div>
                </div>
        
                <div class="bottom-section">
                    <div class="photos-section">
                        <h3>Photos: </h3>
                        <div class="photo-movie">
                            <?php foreach ($moviePhoto as $photo) {
                                $imgSrc = $photo['path'] . $photo['photo'];
                            ?>
                                <img src="<?=$imgSrc?>" class="photos" onclick="openModal('<?=$imgSrc?>')">
                            <?php } ?>
                        </div>
                    </div>
                
                    <div class="cast-section">
                        <h3>Cast:</h3>
                        <div class="cast-movie">
                            <?php foreach ($movieCast as $cast) {
                                $imgSrc = $cast['path'] . $cast['photo'];
                            ?>
                                <div class="caster">
                                    <img src="<?=$imgSrc?>" class="photos">
                                    <p><?=$cast['name']?></p>
                                    <p><?=$cast['role']?></p> 
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="comment-section">
        	<h2>Comment Section</h2>
        	<form id="comForm"  method="POST">
        	    <h4>Send your comment</h4>
        		<textarea class="commentText" id="commentText" placeholder="Input your comment here"></textarea>
                <input type="hidden" class="dateCom" id="dateCom" value="<?=date('Y-m-d')?>">
                <br>
                <button type="button" class="submitCom" id="submitCom">Submit</button>
        	</form>
        	<br>
        	<div class="comments-list">
        	</div>
        </section>
        
        <div id="photoModal" class="photo-modal">
        	<span class="photo-close" onclick="closeModal()">&times;</span>
        	<img class="photo-content" id="modalImage">
        </div>
        
        <?php if (isset($_SESSION['id_user'])) {?>
            <script> 
            	const startStars = <?=$rate?>;
            	const role = <?=json_encode($_SESSION['role'])?>;
            </script>
            <script src="scripts/JavaScript/rate.js"></script>
			<script src="scripts/JavaScript/dropdownList.js"></script>
        <?php } ?>
        
		<script src="scripts/JavaScript/photoModal.js"></script>
		<script src="scripts/JavaScript/commentSection.js"></script>
<?php 
    }
}
?>