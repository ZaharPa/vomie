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