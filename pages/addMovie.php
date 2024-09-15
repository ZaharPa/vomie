<?php
use scripts\class\Movie;
use scripts\Database;

if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') 
{
?>

    <div class="add-movie">
    	<h2>ADD NEW ENTERTAIMENT</h2>
    	<form id="form_add_movie" method="post" enctype="multipart/form-data" action="index.php?page=add-movie">
    		<div class="form-group">
        		<label for="title">Title</label>
        		<input type="text" name="title" id="title" required>
    		</div>
    		
    		<label for="description">Description</label>
    		<textarea id="description" name="description" rows="10" cols="50" placeholder="Enter your description film here"></textarea>
    		<div class="form-group">
    			<label for="release-date">Release Date</label>
    			<input type="date" name="release-date" id="release-date" required>
    		
    			<label for="duration">Duration</label>
    			<input type="time" id="duration" name="duration" step="1">
    		</div>
    		
    		
    		<div class="form-group">
    			<label for="type-option">Type</label>
    			<input list="types" id="type-option" name="type-option" />
    			<datalist id="types">
    				<option value="movie">
    				<option value="serial">
    				<option value="cartoon movie">
    				<option value="cartoon series">
    				<option value="anime">
    			</datalist>
    			
    			<label for="status-option">Status</label>
    			<input list="status" id="status-option" name="status-option" />
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
            		<input type="checkbox" name="genres[]" id="horror" value="horror">
            		<label for="horror" class="genre-label">horror</label>
            		
            		<input type="checkbox" name="genres[]" id="drama" value="drama">
            		<label for="drama" class="genre-label">drama</label>
            		
            		<input type="checkbox" name="genres[]" id="science" value="science">
            		<label for="science" class="genre-label">science</label>
            		
            		<input type="checkbox" name="genres[]" id="comedy" value="comedy">
            		<label for="comedy" class="genre-label">comedy</label>
            		
            		<input type="checkbox" name="genres[]" id="action" value="action">
            		<label for="action" class="genre-label">action</label>
            		
            		<input type="checkbox" name="genres[]" id="documentary" value="documentary">
            		<label for="documentary" class="genre-label">documentary</label>
            		
            		<input type="checkbox" name="genres[]" id="fantasy" value="fantasy">
            		<label for="fantasy" class="genre-label">fantasy</label>
            		
            		<input type="checkbox" name="genres[]" id="musical" value="musical">
            		<label for="musical" class="genre-label">musical</label>
            		
            		<input type="checkbox" name="genres[]" id="sports" value="sports">
            		<label for="sports" class="genre-label">sports</label>
            		
            		<input type="checkbox" name="genres[]" id="romance" value="romance">
            		<label for="romance" class="genre-label">romance</label>
            		
            		<input type="checkbox" name="genres[]" id="thriller" value="thriller">
            		<label for="thriller" class="genre-label">thriller</label>
            		
            		<input type="checkbox" name="genres[]" id="spy" value="spy">
            		<label for="spy" class="genre-label">spy</label>
            		
            		<input type="checkbox" name="genres[]" id="crime" value="crime">
        			<label for="crime" class="genre-label">crime</label>
        		</div>
    		</div>
    		
    		
    		<div class="form-group">
    			<label>Photo</label>			
    			<div class="upload-container">
                    <label for="file-input-1" class="file-upload-label">
                        <input type="file" class="file-input" name="photos[]" id="file-input-1" accept="image/*" />
                        <img id="preview-1" src="styles/black-plus.png" alt="Upload Image" />
                    </label>
    			</div>
    			
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
</body>
</html>


<?php
    if (!empty($_POST))
    {
        $curMovie = new Movie();
        $link = Database::getLink();
        $titleMovie = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
        $descriptionMovie = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
        $dateMovie = htmlspecialchars($_POST['release-date'], ENT_QUOTES, 'UTF-8');
        $durationMovie = htmlspecialchars($_POST['duration'], ENT_QUOTES, 'UTF-8');
        $typeMovie = htmlspecialchars($_POST['type-option'], ENT_QUOTES, 'UTF-8');
        $statusMovie = htmlspecialchars($_POST['status-option'], ENT_QUOTES, 'UTF-8');
        
        if ($curMovie->addMovie($link, $titleMovie, $dateMovie, $descriptionMovie, $statusMovie, $typeMovie, $durationMovie) === true) {
            $id_movie = $curMovie->getIdMovie();
            
           if (isset($_POST['genres'])) {
                $selectGenres = $_POST['genres'];
                if(!empty($selectGenres)) {
                    foreach ($selectGenres as $genre)
                        $curMovie->addGenre($link, $id_movie, $genre);
                }
            }
            
            if (isset($_FILES['photos'])) {
                $totalFiles = count($_FILES['photos']['name']);
                
                for ($i = 0; $i < $totalFiles; $i++) {
                    if($_FILES && $_FILES["photos"]["error"][$i] == UPLOAD_ERR_OK) {
                        $fileMime = mime_content_type($_FILES["photos"]["tmp_name"][$i]);
                        $allowedMime = ['image/jpeg', 'image/png'];
                        
                        if(in_array($fileMime, $allowedMime)) {
                            $fileExtension = ($fileMime === 'image/jpeg') ? 'jpg' : 'png';
                            $newFileName = $id_movie . '_' . $titleMovie  . '_' . $i . '.' . $fileExtension;
                            $path = 'images/moviePhoto/';
                            
                            if ($curMovie->addPhoto($link, $id_movie, $path, $newFileName) === true) {
                                move_uploaded_file($_FILES["photos"]["tmp_name"][$i], $path . $newFileName);
                            } else {
                                echo '<script type="text/javascript">',
                                'showModal("Incorrect data photo");',
                                '</script>';
                            }
                        } else {
                            echo '<script type="text/javascript">',
                            'showModal("Incorrect type file");',
                            '</script>';
                        }
                    }
                }
            }
            
            if (!empty(array_filter($_POST['nameCast'])) && !empty(array_filter($_POST['roleCast']))) {
                 $nameCast = $_POST['nameCast'];
                 $roleCast = $_POST['roleCast'];
                 $totalCast = count($nameCast);
      
                 for ($i = 0; $i < $totalCast; $i++) {
                     if (!empty($_POST['nameCast'][$i]) && !empty($_POST['roleCast'][$i])) {
                         if($_FILES && $_FILES["photosCast"]["error"][$i] == UPLOAD_ERR_OK) {
                             $fileMime = mime_content_type($_FILES["photosCast"]["tmp_name"][$i]);
                             $allowedMime = ['image/jpeg', 'image/png'];
                             
                             if(in_array($fileMime, $allowedMime)) {
                                 $fileExtension = ($fileMime === 'image/jpeg') ? 'jpg' : 'png';
                                 $newFileName = $id_movie . '_' . $nameCast[$i]  . '_' . $i . '.' . $fileExtension;
                                 $path = 'images/castPhoto/';

                                 if ($curMovie->addCast($link, $id_movie, $nameCast[$i], $roleCast[$i], $path, $newFileName) === true) {
                                     move_uploaded_file($_FILES["photosCast"]["tmp_name"][$i], $path . $newFileName);
                                 } else {
                                 echo '<script type="text/javascript">',
                                 'showModal("Incorrect data photo");',
                                 '</script>';
                                 }
                             } else {
                             echo '<script type="text/javascript">',
                             'showModal("Incorrect type file");',
                             '</script>';
                             }
                         } else {
                         $curMovie->addCast($link, $id_movie, $nameCast[$i], $roleCast[$i]);
                         }
                     }
                 }
             }
            
            if (!empty(array_filter($_POST['nameLink'])) && !empty(array_filter($_POST['linkMovie']))) {
                $nameLink = $_POST['nameLink'];
                $linkMovie = $_POST['linkMovie'];
                $totalLink = count($nameLink);
                
                for ($i = 0; $i < $totalLink; $i++) {
                    if (!empty($_POST['nameLink'][$i]) && !empty($_POST['linkMovie'][$i]))
                        $curMovie->addLink($link, $id_movie, $nameLink[$i], $linkMovie[$i]);
                }
            }
            
            header('Location: index.php?page=main');
            exit();
        } else {
            echo '<script type="text/javascript">',
            'showModal("Incorrect data");',
            '</script>';
        }
    }
}
?>