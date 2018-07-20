
<?php
if (isset($_POST['title'])) {
	$published = isset($_POST['published']) ? 1 : 0;
	$result = $pdo->prepare('INSERT INTO posts (title, body, category_id, published, meta_description) VALUES (:title, :body, :category_id, :published, :meta_description)');
	$result->bindParam(':title', $_POST['title']);
	$result->bindParam(':body', $_POST['body']);
	$result->bindParam(':category_id', $_POST['category_id']);
	$result->bindParam(':published', $published);
	$result->bindParam(':meta_description', $_POST['meta_description']);
	$result->execute();
	$_SESSION['communique'] = 'Post został dodany';
}
$result = $pdo->query('SELECT `id`, `name` FROM `categories`');
$categories = $result->fetchAll();
?>
<div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Post</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Post Title</label>
          <input type="text" name ="title" class="form-control" placeholder="Page Title">
        </div>
        <div class="form-group">
          <label>Post Body</label>
          <textarea name="body" class="form-control" placeholder="Page Body"></textarea>
        </div>
        <div class="checkbox" >
          <label>
            <input type="checkbox" name="published"> Published
          </label>
        </div>
       	<div class="form-group">
		   <label>Category</label>
		<select name="category_id" id="" class="form-control">
		<?php
foreach ($categories as $category) {
	echo '<option value="' . $category['id'] . '">';
	echo $category['name'];
	echo '</option>';
}

?>
		>
		</select>

	</div>
        <div class="form-group">
          <label>Meta Description</label>
          <input type="text"  name="meta_description" class="form-control" placeholder="Add Meta Description...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>