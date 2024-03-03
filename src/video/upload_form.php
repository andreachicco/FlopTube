<form action="<?php print(ROOT_PATH); ?>/video/upload.php" method="POST" enctype="multipart/form-data">
    <label class="first-input" for="thumbnail">Thumbnail</label>
    <input type="file" name="thumbnail" id="thumbnail">
    <label for="video">Video</label>
    <input type="file" name="video" id="video">
    <label for="title">Title</label>
    <input type="text" name="title" id="title">
    <label for="desc">Description</label>
    <input type="text" name="desc" id="desc">
    <input type="submit" name="submit" value="Save">
</form>