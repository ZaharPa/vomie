<?php
use scripts\Database;
use scripts\class\Movie;

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $link = Database::getLink();
        $curMovie = new Movie();
        
        $movie = $curMovie->viewOneMovie($link, $id);
        $movieGenre = $curMovie->viewGenreForMovie($link, $id);;
        $movieLink = $curMovie->viewLinkForMovie($link, $id);
        $moviePhoto = $curMovie->viewPhotoForMovie($link, $id);;
        $movieCast = $curMovie->viewCastForMovie($link, $id);
?>

		<div class="add-movie">
			<h2>EDIT ENTERTAIMENT</h2>
			<form method="post" enctype="multpart/form-data" action="index.php?page=edit-movie&id=<?=$id?>">
        		<div class="form-group">
            		<label for="title">Title</label>
            		<input type="text" value="<?=$movie['name']?>" name="title" id="title" required>
        		</div>
        		
        		<label for="description">Description</label>
        		<textarea id="description" name="description" rows="10" cols="50" placeholder="Enter your description film here"><?=$movie['description']?></textarea>
        		<div class="form-group">
        			<label for="release-date">Release Date</label>
        			<input type="date" name="release-date" id="release-date" value="<?=$movie['date']?>" required>
        		
        			<label for="duration">Duration</label>
        			<input type="time" id="duration" name="duration" step="1" value="<?=$movie['duration']?>">
        		</div>
        		
        		
        		<div class="form-group">
        			<label for="type-option">Type</label>
        			<input list="types" id="type-option" value="<?=$movie['type']?>" name="type-option" />
        			<datalist id="types">
        				<option value="movie">
        				<option value="serial">
        				<option value="cartoon movie">
        				<option value="cartoon series">
        				<option value="anime">
        			</datalist>
        			
        			<label for="status-option">Status</label>
        			<input list="status" id="status-option" value="<?=$movie['status']?>" name="status-option" />
        			<datalist id="status">
        				<option value="in development">
        				<option value="ongoing">
        				<option value="completed">
        				<option value="canceled">
        			</datalist>
        		</div>
        		
        		
        		<div class="form-group">
            		<label>Genre</label>
            		<div class="genre-options">	
                		<?php 
                		$allGenres = [
                		    'horror', 'drama', 'science', 'comedy', 'action', 'documentary',
                		    'fantasy', 'musical', 'sports', 'romance', 'thriller', 'spy', 'crime'
                		];
                		var_dump($moviePhoto[1]);
                		$selectedGenres = array_map(function($genre) {
                		    return $genre['genre'];
                		}, $movieGenre);
                		
                		foreach ($allGenres as $genre) {
                		?>
                			<input type="checkbox" name="genres[]" id="<?=$genre?>" value="<?=$genre?>"
                			<?= in_array($genre,$selectedGenres) ? 'checked' : ''?>>
                			<label for="<?=$genre?>" class="genre-label"><?=$genre?></label>
                		<?php }?>	
            		</div>
        		</div>
        		
        		
        		<div class="form-group">
        			<label>Photo</label>		
        			<?php 
        			$hidden = false;
        			for ($i = 0; $i < 10; $i++) {
        			    if (!empty($moviePhoto[$i])) {
        			        $imgSrc = $moviePhoto[$i]['path'] . $moviePhoto[$i]['photo'];
        			    } else $imgSrc = '';
        			    
        			    if ($hidden === true) {
        				?>
        					<div class="upload-container hidden">
						<?php } else {?>
            				<div class="upload-container">
            			<?php }?>
                            <label for="file-input-<?=$i?>" class="file-upload-label">
                                <input type="file" class="file-input" name="photos[]" id="file-input-<?=$i?>" accept="image/*" required />
                                <img id="preview-<?=$i?>"  alt="Upload Image" 
                                <?php if (!empty($imgSrc)) { ?>
               						src="<?=$imgSrc?>"
               					<?php } else {?>
               						src="styles/black-plus.png"
               					<?php }?> />
                            </label>
            			</div>
        			<?php 
        			     if (empty($imgSrc) && $i > 2 && $hidden === false) {
        			            $hidden = true;
        			    }
        			}
        			?>
        		</div>
        		
        		
        		<div class="form-group">
        			<label>Cast</label>	
        			<?php 
        			$hidden = false;
        			for ($i = 0; $i < 10; $i++) {
        			    if (!empty($movieCast[$i])) {
        			        $imgSrc = $movieCast[$i]['path'] . $movieCast[$i]['photo'];
        			        $name = $movieCast[$i]['name'];
        			        $role = $movieCast[$i]['role'];
        			    } else {
        			        $imgSrc = '';
        			        $name = '';
        			        $role = '';
        			    }
        			    if ($i > 0 && $hidden === false) {
        			        
        			    ?>
            			        <div class="form-group">
    								<button type="button" class="showMore">+</button>			
    								<div class="form-group hidden">
    								
              			<?php }
            			    elseif ($i > 0 && $hidden === true) {
                            ?> 
            			        <div class="form-group hidden">
    								<button type="button" class="showMore">+</button>			
    								<div class="form-group">
               			<?php } elseif ($i === 9) {?>	
    						<div class="form-group hidden">
    							<div class="form-group">
              			<?php } elseif ($i === 0) {?>	
              				<div class="form-group">
              				<?php }?>r	
                				<label for="nameCast-<?=$i+1?>">Name</label>
                    			<input type="text" name="nameCast[]" value="<?=$name?>" id="nameCast-<?=$i+1?>">
                    			<label for="roleCast-<?=$i+1?>">Role</label>
                    			<input type="text" name="roleCast[]" value="<?=$role?>" id="roleCast-<?=$i+1?>">
                    			<div class="upload-container cast-photo">
                                	<label for="file-input-cast-<?=$i+1?>" class="file-upload-label">
                               	   		<input type="file" class="file-input" name="photosCast[]" id="file-input-cast-<?=$i+1?>" accept="image/*" />
                              	   	  	<img id="preview-cast-<?=$i+1?>" alt="Upload Image"
                              	   	  	 <?php if (!empty($imgSrc)) { ?>
               						src="<?=$imgSrc?>"
               					<?php } else {?>
               						src="styles/black-plus.png"
               					<?php }?> />
                             	   	</label>
                				</div>
                			</div>
            			</div>
        		
              		<?php 
        			if (empty($name) && $i > 0 && $hidden === false) {
        			            $hidden = true;
        			    }
        			}
        			?>
        			        		
				<div class="form-group">
        			<label>Link</label>	
        			<?php 
        			$hidden = false;
        			for ($i = 0; $i < 5; $i++) {
        			    if (!empty($movieLink[$i])) {
        			        $name = $movieLink[$i]['name'];
        			        $url = $movieLink[$i]['link'];
        			    } else {
        			        $name = '';
        			        $url = '';
        			    }
        			    if ($hidden === true) {
        			        
        			    ?>
            			        <div class="form-group hidden">
    								<button type="button" class="showMore">+</button>			
    								<div class="form-group">
    										
    					<?php }?>
                				<div class="form-group">
                        			<label for="link-name-<?=$i+1?>">Name</label>
                        			<input type="text" name="nameLink[]" id="link-name-<?=$i+1?>" value="<?=$name?>">
                        			<label for="link-<?=$i+1?>">Link</label>
                        			<input type="url" name="linkMovie[]" id="link-<?=$i+1?>" value="<?=$url?>">
                    			</div>
                    		</div>
        		  	
              		<?php
              		if ($hidden = false) {
              		?>
              		<div class="form-group">
                        			<button type="button" class="showMore">+</button>			
                        			<div class="form-group hidden">
                        			</div>
                        		</div>
                      <?php echo 1;  }
                      if (empty($url) && $i > 0 && $hidden === true) {
                          $hidden = false;
        			    }
        			}
        			?>
        		
        		<button class="add-movie-btn">submit</button>
        	</form>
        </div>
        
        <div id="modal" class="modal">
    			<div class="modal-content">
    				<span class="close">&times;</span>
    				<p id="modal-text" class="modal-text"></p>
    			</div>
    	</div>
    	
    	<script src="scripts/JavaScript/previewPhoto.js"></script>
        <script src="scripts/JavaScript/showMore.js"></script>
<?php 
    } 
}
?>