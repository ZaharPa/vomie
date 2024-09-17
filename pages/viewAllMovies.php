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
 			<input type="text" placeholder="Input here name anime">
 		</div>
 	</div>
 	
 	<div class="filters">
		<div class="filter-section">
 			<button class="filter-toggle">Genre</button>
 			<div class="filter-options">
 				<span class="filter-option">horror</span>
 				<span class="filter-option">drama</span>
 				<span class="filter-option">science</span>
 				<span class="filter-option">comedy</span>
 				<span class="filter-option">action</span>
 				<span class="filter-option">documentary</span>
 				<span class="filter-option">fantasy</span>
 				<span class="filter-option">musical</span>
 				<span class="filter-option">sports</span>
 				<span class="filter-option">romance</span>
 				<span class="filter-option">thriller</span>
 				<span class="filter-option">spy</span>
 				<span class="filter-option">crime</span>
 			</div>
 		</div>
 		
 		<div class="filter-section">
 			<button class="filter-toggle">Status</button>
 			<div class="filter-options">
 				<span class="filter-option">movie</span>
 				<span class="filter-option">serial</span>
 				<span class="filter-option">cartoon movie</span>
 				<span class="filter-option">cartoon series</span>
 				<span class="filter-option">anime</span>
 			</div>
 		</div>
 		
 		<div class="filter-section">
 			<button class="filter-toggle">Year</button>
 			<div class="year-slider">
 				<input type="number" id="year-min" value="1900" readonly>
 				<div id="slider"></div>
 				<input type="number" id="year-max" value="2024" readonly>
 			</div>
 		</div>
 	</div>
 	
 	<div class="movie-list">
 		<?php  for ($i = $startIndex; $i < $endIndex; $i++) { 
 		    for($x = 0; $x < count($photoMovie); $x++) {
 		        if($photoMovie[$x]['id_movie'] === $movies[$i]['id_movie']) {
 		             $imgSrc = $photoMovie[$x]['path'] . $photoMovie[$x]['photo'];
 		             break;
 		        }
 		    }?>
     		<div class="movie-card">
     			<img src='<?=$imgSrc?>' alt="Name movie">
     			<p><?=htmlspecialchars($movies[$i]['name'])?></p>
     		</div>
     	<?php }?>
     </div>
 	
 	<div class="pagination">
 		<?php
    	for ($i = 1; $i <= $totalPages; $i++){
    	   echo "<a href='?page=home&number=$i'>$i</a> ";
    	}
    	?>
 	</div>
</div>