<?php
if (isset($_POST['pagetitle'])) {
$published = isset($_POST['pagepublished']) ? 1 : 0;
$result = $pdo->prepare('INSERT INTO pages (title, body, published, meta_description) VALUES (:title, :body, :published, :meta_description)');
$result->bindParam(':title', $_POST['pagetitle']);
$result->bindParam(':body', $_POST['editor1']);
$result->bindParam(':published', $published);
$result->bindParam(':meta_description', $_POST['pagemeta_description']);
$result->execute();
$_SESSION['communique'] = 'the page has been added';
howManyRecords();
}
?>


    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Page</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Page Title</label>
          <input type="text" name="pagetitle" class="form-control" placeholder="Page Title">
        </div>
        <div class="form-group">
          <label>Page Body</label>
          <textarea name="editor1" class="form-control" placeholder="Page Body"></textarea>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="pagepublished"> Published
          </label>
        </div>
        <div class="form-group">
          <label>Meta Description</label>
          <input type="text" class="form-control" name="pagemeta_description" placeholder="Add Meta Description...">
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