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
		<div class="upload-container">
        <label for="file-input" class="file-upload-label">
            <input type="file" id="file-input" accept="image/*" />
            <div class="file-upload-text">Choose an image</div>
        </label>
			<div class="preview-container">
				<img id="preview" src="" alt="Image Preview" />
			</div>
		</div>
	</form>
</div>
<script src="scripts/JavaScript/previewPhoto.js"></script>