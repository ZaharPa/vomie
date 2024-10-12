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
        
        if (!empty($_POST)) {
            $titleMovie = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
            $descriptionMovie = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
            $dateMovie = htmlspecialchars($_POST['release-date'], ENT_QUOTES, 'UTF-8');
            $durationMovie = htmlspecialchars($_POST['duration'], ENT_QUOTES, 'UTF-8');
            $typeMovie = htmlspecialchars($_POST['type-option'], ENT_QUOTES, 'UTF-8');
            $statusMovie = htmlspecialchars($_POST['status-option'], ENT_QUOTES, 'UTF-8');
                
            if ($curMovie->editMovie($link, $id, $titleMovie, $dateMovie, $descriptionMovie, 
                $statusMovie, $typeMovie, $durationMovie) === true) {
          
                if (isset($_POST['genres'])) {
                    $selectedGenres = $_POST['genres'];
                    if (!empty($selectedGenres)) {
                            $curMovie->editGenre($link, $id, $selectedGenres);
                    }
                }
                
                if (isset($_FILES['photos'])) {
                    $curMovie->editPhoto($link, $id, $_FILES['photos'], $titleMovie);
                } 
              
                if (!empty(array_filter($_POST['nameCast'])) && !empty(array_filter($_POST['roleCast']))) {
                    $nameCast = $_POST['nameCast'];
                    $roleCast = $_POST['roleCast'];
                    $idCast = $_POST['idCast'];
                    $totalCast = count($nameCast);

                    for ($i = 0; $i < $totalCast; $i++) {
                        if (empty($idCast[$i])) {
                            if (!empty($_POST['nameCast'][$i]) && !empty($_POST['roleCast'][$i])) {
                                if (!empty($_POST['nameCast'][$i]) && !empty($_POST['roleCast'][$i])) {
                                    if($_FILES && $_FILES["photosCast"]["error"][$i] == UPLOAD_ERR_OK) {
                                        $fileMime = mime_content_type($_FILES["photosCast"]["tmp_name"][$i]);
                                        $allowedMime = ['image/jpeg', 'image/png'];
                                        
                                        if(in_array($fileMime, $allowedMime)) {
                                            $fileExtension = ($fileMime === 'image/jpeg') ? 'jpg' : 'png';
                                            $newFileName = $id . '_' . $nameCast[$i]  . '_' . $i . '.' . $fileExtension;
                                            $path = 'images/castPhoto/';
                                            
                                            if ($curMovie->addCast($link, $id, $nameCast[$i], $roleCast[$i], $path, $newFileName) === true) {
                                                move_uploaded_file($_FILES["photosCast"]["tmp_name"][$i], $path . $newFileName);
                                            }   
                                        } 
                                    }
                                }
                            }
                        } else {
                            $existingPhoto = isset($_POST['ex_photo_staff'][$idCast[$i]]) ? $_POST['ex_photo_staff'][$idCast[$i]] : '';
                            if ($_FILES && $_FILES["photosCast"]["error"][$i] == UPLOAD_ERR_OK) {
                                $fileMime = mime_content_type($_FILES["photosCast"]["tmp_name"][$i]);
                                $allowedMime = ['image/jpeg', 'image/png'];
                                
                                if (in_array($fileMime, $allowedMime)) {
                                    $fileExtension = ($fileMime === 'image/jpeg') ? 'jpg' : 'png';
                                    $newFileName = $existingPhoto;  
                                    $path = 'images/castPhoto/';
                                    
                                    move_uploaded_file($_FILES["photosCast"]["tmp_name"][$i], $path . $newFileName);
                                }
                            }
                            $curMovie->editCast($link, $id, $idCast[$i], $nameCast[$i], $roleCast[$i], $existingPhoto);
                        }
                    }
                }
                
                if (!empty(array_filter($_POST['nameLink'])) && !empty(array_filter($_POST['linkMovie']))) {
                    $nameLink = $_POST['nameLink'];
                    $linkMovie = $_POST['linkMovie'];
                    $idLink = $_POST['idLink'];
                    $totalLink = count($nameLink);
                    
                    for ($i = 0; $i < $totalLink; $i++) {
                        if (!empty($_POST['nameLink'][$i]) && !empty($_POST['linkMovie'][$i]))
                            $curMovie->editLink($link, $idLink[$i], $nameLink[$i], $linkMovie[$i]);
                    }
                }
                
                header('Location: index.php?page=movieDetail&id=' . $id);
                exit();
                
                
        } else {
            echo '<script type="text/javascript">',
            'showModal("Incorrect data");',
            '</script>';
        }
    }
?>

		<div class="add-movie">
			<h2>EDIT ENTERTAIMENT</h2>
			<form method="post" enctype="multipart/form-data" action="index.php?page=edit-movie&id=<?=$id?>">
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
                        $imgSrc = !empty($moviePhoto[$i]['path']) ? $moviePhoto[$i]['path'] . $moviePhoto[$i]['photo'] : '';
                        
                        if ($hidden === true) {
                    ?>
                        <div class="upload-container hidden">
                    <?php } else { ?>
                        <div class="upload-container">
                    <?php } ?>
                        <label for="file-input-<?=$i?>" class="file-upload-label">
                            <input type="file" class="file-input" name="photos[]" id="file-input-<?=$i?>" accept="image/*" />
                            <img id="preview-<?=$i?>" alt="Upload Image" 
                            src="<?=!empty($imgSrc) ? $imgSrc : 'styles/black-plus.png' ?>" />
                        </label>
                        <?php if (!empty($imgSrc)) { ?>
                           <input type="hidden" name="existing_photos[]" value="<?= $moviePhoto[$i]['photo'] ?>">
                            <button type="button" class="delete-prop-btn photo-btn" onclick="deletePhoto(<?=$i?>)">&times;</button>
                            <input type="hidden" name="delete_photos[<?=$i?>]" id="delete-photo-<?=$i?>" value="">       	
							<?php } ?>
                        </div>
                    <?php 
                        if (empty($imgSrc) && $i > 2 && $hidden === false) {
                            $hidden = true;
                        }
                    } ?>
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
        			        $id_cast = $movieCast[$i]['id_cast_staff'];
        			    } else {
        			        $imgSrc = '';
        			        $name = '';
        			        $role = '';
        			        $id_cast = '';
        			    }
        			    if ($i > 0 && $hidden === false) {
        			        
        			    ?>
            			        <div class="form-group">
    								<button type="button" class="showMore">+</button>			
    								<div class="form-group ">
    								
              			<?php }
            			    elseif ($i > 0 && $hidden === true) {
                            ?> 
            			        <div class="form-group hidden">
    								<button type="button" class="showMore">+</button>			
    								<div class="form-group">
               			<?php } elseif ($i === 0) {?>	
              				<div class="form-group">
              				<?php }?>	
                				<label for="nameCast-<?=$i?>">Name</label>
                    			<input type="text" name="nameCast[]" value="<?=$name?>" id="nameCast-<?=$i?>">
                    			<label for="roleCast-<?=$i?>">Role</label>
                    			<input type="text" name="roleCast[]" value="<?=$role?>" id="roleCast-<?=$i?>">
                    			<input type="hidden" name="idCast[]" id="id-link-<?=$i+1?>" value="<?=$id_cast?>">
                    			<div class="upload-container cast-photo">
                                	<label for="file-input-cast-<?=$i?>" class="file-upload-label">
                               	   		<input type="file" class="file-input" name="photosCast[]" id="file-input-cast-<?=$i?>" accept="image/*" />
                              	   	  	<img id="preview-cast-<?=$i?>" alt="Upload Image"
                              	   	  	 <?php if (!empty($imgSrc)) { ?>
               						src="<?=$imgSrc?>"
               					<?php } else {?>
               						src="styles/black-plus.png"
               					<?php }?> />
                             	   	</label>
                				</div>
                					<?php if (!empty($name)) {?>
                    		  			<button type="button" class="delete-prop-btn" onclick="deleteCast(<?=$id_cast?>)">&times;</button>
                             	   		<input type="hidden" name="delete_cast[<?=$id_cast?>]" id="delete-cast-<?=$id_cast?>" value=''>                             	   		
										<input type="hidden" name="ex_photo_staff[<?=$id_cast?>]" value="<?=$movieCast[$i]['photo']?>">
                             	   	<?php }?>
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
        			        $id_link = $movieLink[$i]['id_link'];
        			    } else {
        			        $name = '';
        			        $url = '';
        			        $id_link = '';
        			    }

        			    if (empty($url) && $i > 0 && $hidden === false) {
        			        $hidden = true;
        			    }
        			    if ($hidden === true) {
        			        
        			    ?>
            			        <div class="form-group hidden">
    								<button type="button" class="showMore">+</button>					
    					<?php }?> 
                				<div class="form-group">
                        			<label for="link-name-<?=$i+1?>">Name</label>
                        			<input type="text" name="nameLink[]" id="link-name-<?=$i+1?>" value="<?=$name?>">
                        			<label for="link-<?=$i+1?>">Link</label>
                        			<input type="url" name="linkMovie[]" id="link-<?=$i+1?>" value="<?=$url?>">
                        			<input type="hidden" name="idLink[]" id="id-link-<?=$i+1?>" value="<?=$id_link?>">
                    			</div>
                    			<?php if (!empty($url)) {?>
                    		  		<button type="button" class="delete-prop-btn" onclick="deleteLink(<?=$id_link?>)">&times;</button>
                                    <input type="hidden" name="delete_link[<?=$id_link?>]" id="delete-link-<?=$id_link?>" value="">     
                          		<?php } ?>
                    		</div>
        		  	<?php
              		if ($hidden === false) {
              		?>
              		<div>
              			<div class="form-group">
                        	<button type="button" class="showMore">+</button>			
                        	<div class="form-group hidden">
                        	</div>
                        </div>
                      <?php 
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
    	
    	<script src="scripts/JavaScript/deleteProperty.js"></script>
    	<script src="scripts/JavaScript/previewPhoto.js"></script>
        <script src="scripts/JavaScript/showMore.js"></script>
<?php 
    } 
}
?>