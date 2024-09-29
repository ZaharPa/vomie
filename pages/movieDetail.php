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
            <div class="left-column">
                <img src="<?=$imgSrc?>" class="poster">
                <div class="movie-details">
                    <p><strong>Status:</strong> <?=$movie['status']?></p>
                    <p><strong>Type:</strong> <?=$movie['type']?></p>
                    <p><strong>Date release:</strong> <?=$movie['date']?></p>
                    <p><strong>Duration:</strong> <?=$movie['duration']?></p>
                </div>
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
                    <h3>Link:</h3>
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
        </div>
        
        <div id="photoModal" class="photo-modal">
        	<span class="photo-close" onclick="closeModal()">&times;</span>
        	<img class="photo-content" id="modalImage">
        </div>
		
		<script src="scripts/JavaScript/photoModal.js"></script>

<?php 
    }
}
?>