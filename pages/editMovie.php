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
        			for ($i = 0; $i <= 2; $i++) {
        			    if (!empty($moviePhoto[$i])) {
        			        $imgSrc = $moviePhoto[$i]['path'] . $moviePhoto[$i]['photo'];
        			    } else $imgSrc = '';
        				?>
            			<div class="upload-container">
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
        			<?php }?>
        			
        			<div class="upload-container">
                        <label for="file-input-2" class="file-upload-label">
                            <input type="file" class="file-input" name="photos[]" id="file-input-2" accept="image/*" />
                            <img id="preview-2" src="styles/black-plus.png" alt="Upload Image" />
                        </label>
        			</div>
        			
        			<div class="upload-container">
                        <label for="file-input-3" class="file-upload-label">
                            <input type="file" class="file-input" name="photos[]" id="file-input-3" accept="image/*" />
                            <img id="preview-3" src="styles/black-plus.png" alt="Upload Image" />
                        </label>
        			</div>
        			<div class="upload-container hidden">
                        <label for="file-input-4" class="file-upload-label">
                            <input type="file" class="file-input" name="photos[]" id="file-input-4" accept="image/*" />
                            <img id="preview-4" src="styles/black-plus.png" alt="Upload Image" />
                        </label>
        			</div>
        			
        			<div class="upload-container hidden">
                        <label for="file-input-5" class="file-upload-label">
                            <input type="file" class="file-input" name="photos[]" id="file-input-5" accept="image/*" />
                            <img id="preview-5" src="styles/black-plus.png" alt="Upload Image" />
                        </label>
        			</div>
        			
        			<div class="upload-container hidden">
                        <label for="file-input-6" class="file-upload-label">
                            <input type="file" class="file-input" name="photos[]" id="file-input-6" accept="image/*" />
                            <img id="preview-6" src="styles/black-plus.png" alt="Upload Image" />
                        </label>
        			</div>
        			
        			<div class="upload-container hidden">
                        <label for="file-input-7" class="file-upload-label">
                            <input type="file" class="file-input" name="photos[]" id="file-input-7" accept="image/*" />
                            <img id="preview-7" src="styles/black-plus.png" alt="Upload Image" />
                        </label>
        			</div>
        			
        			<div class="upload-container hidden">
                        <label for="file-input-8" class="file-upload-label">
                            <input type="file" class="file-input" name="photos[]" id="file-input-8" accept="image/*" />
                            <img id="preview-8" src="styles/black-plus.png" alt="Upload Image" />
                        </label>
        			</div>
        			
        			<div class="upload-container hidden">
                        <label for="file-input-9" class="file-upload-label">
                            <input type="file" class="file-input" name="photos[]" id="file-input-9" accept="image/*" />
                            <img id="preview-9" src="styles/black-plus.png" alt="Upload Image" />
                        </label>
        			</div>
        		</div>
        		
        		
        		<div class="form-group">
        			<label>Cast</label>			
        			<div class="form-group">
            			<label for="nameCast-1">Name</label>
            			<input type="text" name="nameCast[]" id="nameCast-1">
            			<label for="roleCast-1">Role</label>
            			<input type="text" name="roleCast[]" id="roleCast-1">
            			<div class="upload-container cast-photo">
                        	<label for="file-input-cast-1" class="file-upload-label">
                       	    	<input type="file" class="file-input" name="photosCast[]" id="file-input-cast-1" accept="image/*" />
                         	  	<img id="preview-cast-1" src="styles/black-plus.png" alt="Upload Image" />
                        </label>
        				</div>
        			</div>
        		</div>
        		
        		<div class="form-group">
        			<button type="button" class="showMore">+</button>			
        			<div class="form-group hidden">
                		<label for="nameCast-2">Name</label>
                		<input type="text" name="nameCast[]" id="nameCast-2">
                		<label for="roleCast-2">Role</label>
                		<input type="text" name="roleCast[]" id="roleCast-2">
                		<div class="upload-container cast-photo">
                            <label for="file-input-cast-2" class="file-upload-label">
                           	    <input type="file" class="file-input" name="photosCast[]" id="file-input-cast-2" accept="image/*" />
                             	<img id="preview-cast-2" src="styles/black-plus.png" alt="Upload Image" />
                           </label>
        				</div>
        			</div>
        		</div>
        		
        		<div class="form-group hidden">
        			<button type="button" class="showMore">+</button>			
        			<div class="form-group">
                		<label for="nameCast-3">Name</label>
                		<input type="text" name="nameCast[]" id="nameCast-3">
                		<label for="roleCast-3">Role</label>
                		<input type="text" name="roleCast[]" id="roleCast-3">
                		<div class="upload-container cast-photo">
                            <label for="file-input-cast-3" class="file-upload-label">
                           	    <input type="file" class="file-input" name="photosCast[]" id="file-input-cast-3" accept="image/*" />
                             	<img id="preview-cast-3" src="styles/black-plus.png" alt="Upload Image" />
                           </label>
        				</div>
        			</div>
        		</div>
        		
        		<div class="form-group hidden">
        			<button type="button" class="showMore">+</button>			
        			<div class="form-group">
                		<label for="nameCast-4">Name</label>
                		<input type="text" name="nameCast[]" id="nameCast-4">
                		<label for="roleCast-4">Role</label>
                		<input type="text" name="roleCast[]" id="roleCast-4">
                		<div class="upload-container cast-photo">
                            <label for="file-input-cast-4" class="file-upload-label">
                           	    <input type="file" class="file-input" name="photosCast[]" id="file-input-cast-4" accept="image/*" />
                             	<img id="preview-cast-4" src="styles/black-plus.png" alt="Upload Image" />
                           </label>
        				</div>
        			</div>
        		</div>
        		
        		<div class="form-group hidden">
        			<button type="button" class="showMore">+</button>			
        			<div class="form-group">
                		<label for="nameCast-5">Name</label>
                		<input type="text" name="nameCast[]" id="nameCast-5">
                		<label for="roleCast-5">Role</label>
                		<input type="text" name="roleCast[]" id="roleCast-5">
                		<div class="upload-container cast-photo">
                            <label for="file-input-cast-5" class="file-upload-label">
                           	    <input type="file" class="file-input" name="photosCast[]" id="file-input-cast-5" accept="image/*" />
                             	<img id="preview-cast-5" src="styles/black-plus.png" alt="Upload Image" />
                           </label>
        				</div>
        			</div>
        		</div>
        		
        		<div class="form-group hidden">
        			<button type="button" class="showMore">+</button>			
        			<div class="form-group">
                		<label for="nameCast-6">Name</label>
                		<input type="text" name="nameCast[]" id="nameCast-6">
                		<label for="roleCast-6">Role</label>
                		<input type="text" name="roleCast[]" id="roleCast-6">
                		<div class="upload-container cast-photo">
                            <label for="file-input-cast-6" class="file-upload-label">
                           	    <input type="file" class="file-input" name="photosCast[]" id="file-input-cast-6" accept="image/*" />
                             	<img id="preview-cast-6" src="styles/black-plus.png" alt="Upload Image" />
                           </label>
        				</div>
        			</div>
        		</div>
        		
        		<div class="form-group hidden">
        			<button type="button" class="showMore">+</button>			
        			<div class="form-group">
                		<label for="nameCast-7">Name</label>
                		<input type="text" name="nameCast[]" id="nameCast-7">
                		<label for="roleCast-7">Role</label>
                		<input type="text" name="roleCast[]" id="roleCast-7">
                		<div class="upload-container cast-photo">
                            <label for="file-input-cast-7" class="file-upload-label">
                           	    <input type="file" class="file-input" name="photosCast[]" id="file-input-cast-7" accept="image/*" />
                             	<img id="preview-cast-7" src="styles/black-plus.png" alt="Upload Image" />
                           </label>
        				</div>
        			</div>
        		</div>
        		
        		<div class="form-group hidden">
        			<button type="button" class="showMore">+</button>			
        			<div class="form-group">
                		<label for="nameCast-8">Name</label>
                		<input type="text" name="nameCast[]" id="nameCast-8">
                		<label for="roleCast-8">Role</label>
                		<input type="text" name="roleCast[]" id="roleCast-8">
                		<div class="upload-container cast-photo">
                            <label for="file-input-cast-8" class="file-upload-label">
                           	    <input type="file" class="file-input" name="photosCast[]" id="file-input-cast-8" accept="image/*" />
                             	<img id="preview-cast-8" src="styles/black-plus.png" alt="Upload Image" />
                           </label>
        				</div>
        			</div>
        		</div>
        		
        		<div class="form-group hidden">
        			<button type="button" class="showMore">+</button>			
        			<div class="form-group">
                		<label for="nameCast-9">Name</label>
                		<input type="text" name="nameCast[]" id="nameCast-9">
                		<label for="roleCast-9">Role</label>
                		<input type="text" name="roleCast[]" id="roleCast-9">
                		<div class="upload-container cast-photo">
                            <label for="file-input-cast-9" class="file-upload-label">
                           	    <input type="file" class="file-input" name="photosCast[]" id="file-input-cast-9" accept="image/*" />
                             	<img id="preview-cast-9" src="styles/black-plus.png" alt="Upload Image" />
                           </label>
        				</div>
        			</div>
        		</div>
        		
        		<div class="form-group hidden">
        			<div class="form-group">
                		<label for="nameCast-10">Name</label>
                		<input type="text" name="nameCast[]" id="nameCast-10">
                		<label for="roleCast-10">Role</label>
                		<input type="text" name="roleCast[]" id="roleCast-10">
                		<div class="upload-container cast-photo">
                            <label for="file-input-cast-10" class="file-upload-label">
                           	    <input type="file" class="file-input" name="photosCast[]" id="file-input-cast-10" accept="image/*" />
                             	<img id="preview-cast-10" src="styles/black-plus.png" alt="Upload Image" />
                           </label>
        				</div>
        			</div>
        		</div>
        		
        		
        		<div class="form-group">
        			<label>Link</label>			
        			<div class="form-group">
            			<label for="link-name-1">Name</label>
            			<input type="text" name="nameLink[]" id="link-name-1">
            			<label for="link-1">Link</label>
            			<input type="url" name="linkMovie[]" id="link-1">
        			</div>
        		</div>
        		
        		<div class="form-group">
        			<button type="button" class="showMore">+</button>			
        			<div class="form-group hidden">
        			</div>
        		</div>
        		
        		<div class="form-group hidden">
        			<button type="button" class="showMore">+</button>			
        			<div class="form-group">
                		<label for="link-name-2">Name</label>
            			<input type="text" name="nameLink[]" id="link-name-2">
            			<label for="link-2">Link</label>
            			<input type="url" name="linkMovie[]" id="link-2">
        			</div>
        		</div>
        		
        		<div class="form-group hidden">
        			<button type="button" class="showMore">+</button>			
        			<div class="form-group">
                		<label for="link-name-3">Name</label>
            			<input type="text" name="nameLink[]" id="link-name-3">
            			<label for="link-3">Link</label>
            			<input type="url" name="linkMovie[]" id="link-3">
        			</div>
        		</div>
        		
        		<div class="form-group hidden">
        			<button type="button" class="showMore">+</button>			
        			<div class="form-group">
                		<label for="link-name-4">Name</label>
            			<input type="text" name="nameLink[]" id="link-name-4">
            			<label for="link-4">Link</label>
            			<input type="url" name="linkMovie[]" id="link-4">
        			</div>
        		</div>
        		
        		<div class="form-group hidden">		
        			<div class="form-group">
                		<label for="link-name-5">Name</label>
            			<input type="text" name="nameLink[]" id="link-name-5">
            			<label for="link-5">Link</label>
            			<input type="url" name="linkMovie[]" id="link-5">
        			</div>
        		</div>
        		
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