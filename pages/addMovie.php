<?php
?>

<div class="add-movie">
	<h2>ADD NEW ENTERTAIMENT</h2>
	<form id="form_add_movie" method="post" action="index.php?page=add-movie">
		<div class="form-group">
    		<label for="title">Title</label>
    		<input type="text" name="title" id="title" required>
		</div>
		
		<label for="description">Description</label>
		<textarea id="description" name="description" rows="10" cols="50" placeholder="Enter your description film here"></textarea>
		<div class="form-group">
			<label for="release-date">Release Date</label>
			<input type="date" name="release-date" id="release-date" required>
		</div>
		
		<div class="form-group">
    		<label>Genre</label>
    		<div class="genre-options">	
        		<input type="checkbox" name="horror" id="horror" value="horror">
        		<label for="horror" class="genre-label">horror</label>
        		
        		<input type="checkbox" name="drama" id="drama" value="drama">
        		<label for="drama" class="genre-label">drama</label>
        		
        		<input type="checkbox" name="science" id="science" value="science">
        		<label for="science" class="genre-label">science</label>
        		
        		<input type="checkbox" name="comedy" id="comedy" value="comedy">
        		<label for="comedy" class="genre-label">comedy</label>
        		
        		<input type="checkbox" name="action" id="action" value="action">
        		<label for="action" class="genre-label">action</label>
        		
        		<input type="checkbox" name="documentary" id="documentary" value="documentary">
        		<label for="documentary" class="genre-label">documentary</label>
        		
        		<input type="checkbox" name="fantasy" id="fantasy" value="fantasy">
        		<label for="fantasy" class="genre-label">fantasy</label>
        		
        		<input type="checkbox" name="musical" id="musical" value="musical">
        		<label for="musical" class="genre-label">musical</label>
        		
        		<input type="checkbox" name="sports" id="sports" value="sports">
        		<label for="sports" class="genre-label">sports</label>
        		
        		<input type="checkbox" name="romance" id="romance" value="romance">
        		<label for="romance" class="genre-label">romance</label>
        		
        		<input type="checkbox" name="thriller" id="thriller" value="thriller">
        		<label for="thriller" class="genre-label">thriller</label>
        		
        		<input type="checkbox" name="spy" id="spy" value="spy">
        		<label for="spy" class="genre-label">spy</label>
        		
        		<input type="checkbox" name="crime" id="crime" value="crime">
    			<label for="crime" class="genre-label">crime</label>
    		</div>
		</div>
		
		<div class="form-group">
			<label>Photo</label>			
			<div class="upload-container">
                <label for="file-input-1" class="file-upload-label">
                    <input type="file" class="file-input" id="file-input-1" accept="image/*" />
                    <img id="preview-1" src="styles/black-plus.png" alt="Upload Image" />
                </label>
			</div>
			<div class="upload-container">
                <label for="file-input-2" class="file-upload-label">
                    <input type="file" class="file-input" id="file-input-2" accept="image/*" />
                    <img id="preview-2" src="styles/black-plus.png" alt="Upload Image" />
                </label>
			</div>
			<div class="upload-container">
                <label for="file-input-3" class="file-upload-label">
                    <input type="file" class="file-input" id="file-input-3" accept="image/*" />
                    <img id="preview-3" src="styles/black-plus.png" alt="Upload Image" />
                </label>
			</div>
			<div class="upload-container hidden">
                <label for="file-input-4" class="file-upload-label">
                    <input type="file" class="file-input" id="file-input-4" accept="image/*" />
                    <img id="preview-4" src="styles/black-plus.png" alt="Upload Image" />
                </label>
			</div>
			<div class="upload-container hidden">
                <label for="file-input-5" class="file-upload-label">
                    <input type="file" class="file-input" id="file-input-5" accept="image/*" />
                    <img id="preview-5" src="styles/black-plus.png" alt="Upload Image" />
                </label>
			</div>
			<div class="upload-container hidden">
                <label for="file-input-6" class="file-upload-label">
                    <input type="file" class="file-input" id="file-input-6" accept="image/*" />
                    <img id="preview-6" src="styles/black-plus.png" alt="Upload Image" />
                </label>
			</div>
			<div class="upload-container hidden">
                <label for="file-input-7" class="file-upload-label">
                    <input type="file" class="file-input" id="file-input-7" accept="image/*" />
                    <img id="preview-7" src="styles/black-plus.png" alt="Upload Image" />
                </label>
			</div>
			<div class="upload-container hidden">
                <label for="file-input-8" class="file-upload-label">
                    <input type="file" class="file-input" id="file-input-8" accept="image/*" />
                    <img id="preview-8" src="styles/black-plus.png" alt="Upload Image" />
                </label>
			</div>
			<div class="upload-container hidden">
                <label for="file-input-9" class="file-upload-label">
                    <input type="file" class="file-input" id="file-input-9" accept="image/*" />
                    <img id="preview-9" src="styles/black-plus.png" alt="Upload Image" />
                </label>
			</div>
		</div>
		
		<div class="form-group">
			<label>Cast</label>			
			<div class="form-group">
    			<label for="nameCast-1">Name</label>
    			<input type="text" name="nameCast-1" id="nameCast-1">
    			<label for="roleCast-1">Role</label>
    			<input type="text" name="roleCast-1" id="roleCast-1">
    			<div class="upload-container cast-photo">
                	<label for="file-input-cast-1" class="file-upload-label">
               	    	<input type="file" class="file-input" id="file-input-cast-1" accept="image/*" />
                 	  	<img id="preview-cast-1" src="styles/black-plus.png" alt="Upload Image" />
                </label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<button type="button" class="showMore">+</button>			
			<div class="form-group hidden">
        		<label for="nameCast-2">Name</label>
        		<input type="text" name="nameCast-2" id="nameCast-2">
        		<label for="roleCast-2">Role</label>
        		<input type="text" name="roleCast-2" id="roleCast-2">
        		<div class="upload-container cast-photo">
                    <label for="file-input-cast-2" class="file-upload-label">
                   	    <input type="file" class="file-input" id="file-input-cast-2" accept="image/*" />
                     	<img id="preview-cast-2" src="styles/black-plus.png" alt="Upload Image" />
                   </label>
				</div>
			</div>
		</div>
		<div class="form-group hidden">
			<button type="button" class="showMore">+</button>			
			<div class="form-group">
        		<label for="nameCast-3">Name</label>
        		<input type="text" name="nameCast-3" id="nameCast-3">
        		<label for="roleCast-3">Role</label>
        		<input type="text" name="roleCast-3" id="roleCast-3">
        		<div class="upload-container cast-photo">
                    <label for="file-input-cast-3" class="file-upload-label">
                   	    <input type="file" class="file-input" id="file-input-cast-3" accept="image/*" />
                     	<img id="preview-cast-3" src="styles/black-plus.png" alt="Upload Image" />
                   </label>
				</div>
			</div>
		</div>
		<div class="form-group hidden">
			<button type="button" class="showMore">+</button>			
			<div class="form-group">
        		<label for="nameCast-4">Name</label>
        		<input type="text" name="nameCast-4" id="nameCast-4">
        		<label for="roleCast-4">Role</label>
        		<input type="text" name="roleCast-4" id="roleCast-4">
        		<div class="upload-container cast-photo">
                    <label for="file-input-cast-4" class="file-upload-label">
                   	    <input type="file" class="file-input" id="file-input-cast-4" accept="image/*" />
                     	<img id="preview-cast-4" src="styles/black-plus.png" alt="Upload Image" />
                   </label>
				</div>
			</div>
		</div>
		<div class="form-group hidden">
			<button type="button" class="showMore">+</button>			
			<div class="form-group">
        		<label for="nameCast-5">Name</label>
        		<input type="text" name="nameCast-5" id="nameCast-5">
        		<label for="roleCast-5">Role</label>
        		<input type="text" name="roleCast-5" id="roleCast-5">
        		<div class="upload-container cast-photo">
                    <label for="file-input-cast-5" class="file-upload-label">
                   	    <input type="file" class="file-input" id="file-input-cast-5" accept="image/*" />
                     	<img id="preview-cast-5" src="styles/black-plus.png" alt="Upload Image" />
                   </label>
				</div>
			</div>
		</div>
		<div class="form-group hidden">
			<button type="button" class="showMore">+</button>			
			<div class="form-group">
        		<label for="nameCast-6">Name</label>
        		<input type="text" name="nameCast-6" id="nameCast-6">
        		<label for="roleCast-6">Role</label>
        		<input type="text" name="roleCast-6" id="roleCast-6">
        		<div class="upload-container cast-photo">
                    <label for="file-input-cast-6" class="file-upload-label">
                   	    <input type="file" class="file-input" id="file-input-cast-6" accept="image/*" />
                     	<img id="preview-cast-6" src="styles/black-plus.png" alt="Upload Image" />
                   </label>
				</div>
			</div>
		</div>
		<div class="form-group hidden">
			<button type="button" class="showMore">+</button>			
			<div class="form-group">
        		<label for="nameCast-7">Name</label>
        		<input type="text" name="nameCast-7" id="nameCast-7">
        		<label for="roleCast-7">Role</label>
        		<input type="text" name="roleCast-7" id="roleCast-7">
        		<div class="upload-container cast-photo">
                    <label for="file-input-cast-7" class="file-upload-label">
                   	    <input type="file" class="file-input" id="file-input-cast-7" accept="image/*" />
                     	<img id="preview-cast-7" src="styles/black-plus.png" alt="Upload Image" />
                   </label>
				</div>
			</div>
		</div>
		<div class="form-group hidden">
			<button type="button" class="showMore">+</button>			
			<div class="form-group">
        		<label for="nameCast-8">Name</label>
        		<input type="text" name="nameCast-8" id="nameCast-8">
        		<label for="roleCast-8">Role</label>
        		<input type="text" name="roleCast-8" id="roleCast-8">
        		<div class="upload-container cast-photo">
                    <label for="file-input-cast-8" class="file-upload-label">
                   	    <input type="file" class="file-input" id="file-input-cast-8" accept="image/*" />
                     	<img id="preview-cast-8" src="styles/black-plus.png" alt="Upload Image" />
                   </label>
				</div>
			</div>
		</div>
		<div class="form-group hidden">
			<button type="button" class="showMore">+</button>			
			<div class="form-group">
        		<label for="nameCast-9">Name</label>
        		<input type="text" name="nameCast-9" id="nameCast-9">
        		<label for="roleCast-9">Role</label>
        		<input type="text" name="roleCast-9" id="roleCast-9">
        		<div class="upload-container cast-photo">
                    <label for="file-input-cast-9" class="file-upload-label">
                   	    <input type="file" class="file-input" id="file-input-cast-9" accept="image/*" />
                     	<img id="preview-cast-9" src="styles/black-plus.png" alt="Upload Image" />
                   </label>
				</div>
			</div>
		</div>
		<div class="form-group hidden">
			<div class="form-group">
        		<label for="nameCast-10">Name</label>
        		<input type="text" name="nameCast-10" id="nameCast-10">
        		<label for="roleCast-10">Role</label>
        		<input type="text" name="roleCast-10" id="roleCast-10">
        		<div class="upload-container cast-photo">
                    <label for="file-input-cast-10" class="file-upload-label">
                   	    <input type="file" class="file-input" id="file-input-cast-10" accept="image/*" />
                     	<img id="preview-cast-10" src="styles/black-plus.png" alt="Upload Image" />
                   </label>
				</div>
			</div>
		</div>
	</form>
</div>
<script src="scripts/JavaScript/previewPhoto.js"></script>
<script src="scripts/JavaScript/showMoreCast.js"></script>