<?php
    use scripts\Database;
    use scripts\class\Movie;

    $link = Database::getLink();
    $curMovie = new Movie();
    
    $movies = $curMovie->viewsAllMovie($link);
    
    $photoMovie = $curMovie->viewPhotosMovie($link);
    
    $itemPerPage = 24;
    $totalItems = count($movies);
    $totalPages = ceil($totalItems / $itemPerPage);
    
    $number = isset($_GET['number']) ? (int)$_GET['number'] : 1;
    
    $startIndex = ($number - 1) * $itemPerPage;
    $endIndex = min($startIndex + $itemPerPage, $totalItems);
?>


<div class="views-all">
 	<div class="container">
 		<div class="search-bar">
 			<input type="text" id="search-input" placeholder="Input here name movie">
 		</div>
 	</div>
 	
 	<div class="movie-section">
 		
 		<div id="movie-list" class="movie-list">
     		<?php for ($i = $startIndex; $i < $endIndex; $i++) { 
     		    for($x = 0; $x < count($photoMovie); $x++) {
     		        if($photoMovie[$x]['id_movie'] === $movies[$i]['id_movie']) {
     		             $imgSrc = $photoMovie[$x]['path'] . $photoMovie[$x]['photo'];
     		             break;
     		        }
     		    }?>
         		<div class="movie-card">
         			<a href="index.php?page=movieDetail&id=<?=$movies[$i]['id_movie']?>">
         				<img src='<?=$imgSrc?>' alt="Name movie">
         			</a>
         			<p><?=htmlspecialchars($movies[$i]['name'])?></p>
         		</div>
         	<?php }?>
         </div>
     	
     	<div class="filters">
			<div class="filter-section" data-filter="genre">
     			<button class="filter-toggle">Genre</button>
     			<div class="filter-options">
     				<span class="filter-option" data-genre="horror">horror</span>
     				<span class="filter-option" data-genre="drama">drama</span>
     				<span class="filter-option" data-genre="science">science</span>
     				<span class="filter-option" data-genre="comedy">comedy</span>
     				<span class="filter-option" data-genre="action">action</span>
     				<span class="filter-option" data-genre="documentary">documentary</span>
     				<span class="filter-option" data-genre="fantasy">fantasy</span>
     				<span class="filter-option" data-genre="musical">musical</span>
     				<span class="filter-option" data-genre="sports">sports</span>
     				<span class="filter-option" data-genre="romance">romance</span>
     				<span class="filter-option" data-genre="thriller">thriller</span>
     				<span class="filter-option" data-genre="spy">spy</span>
     				<span class="filter-option" data-genre="crime">crime</span>
     			</div>
     		</div>
     		
			<div class="filter-section" data-filter="type">
     			<button class="filter-toggle">Type</button>
     			<div class="filter-options">
     				<span class="filter-option" data-type="movie">movie</span>
     				<span class="filter-option" data-type="serial">serial</span>
     				<span class="filter-option" data-type="cartoon movie">cartoon movie</span>
     				<span class="filter-option" data-type="cartoon serials">cartoon series</span>
     				<span class="filter-option" data-type="anime">anime</span>
     			</div>
     		</div>
     		
			<div class="filter-section year-slider" data-filter="year">
     			<button class="filter-toggle">Year</button>
     			<div class="year-slider">
     				<div id="slider"></div>
     				<div class="year-values">
     					<input type="number" id="year-min" value="1900" readonly>
     					<input type="number" id="year-max" value="2025" readonly>
     				</div>
     			</div>
     		</div>
     		
     		<div class="filter-section">
     			<button id="clear-filters">Clear</button>
     		</div>
     	</div>
     	
     	<div class="pagination">
     		<?php
        	for ($i = 1; $i <= $totalPages; $i++){
        	   echo "<a href='?page=home&number=$i'>$i</a> ";
        	}
        	?>
        </div>
 	</div>
</div>
<script>	
	const moviePhoto = <?= json_encode($photoMovie)?>
</script>
<script src="scripts/JavaScript/applyFilters.js"></script>
<script src="scripts/JavaScript/slider.js"></script>
<script src="scripts/JavaScript/filterOptions.js"></script>
<script src="scripts/JavaScript/searchInput.js"></script>