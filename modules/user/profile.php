<?php
if (isset($_SESSION['login'])) {
    if (isset($_POST['submit'])) {
        $file = $_FILES['file'];
        $file_name = $_FILES['file']['name'];
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];
        $file_error = $_FILES['file']['error'];
        $file_temporary_name = $_FILES['file']['tmp_name'];

        $file_ext = explode('.', $file_name);
        $file_actual_ext = strtolower(end($file_ext));

        $allowed = array('jpg', 'jpeg', 'png');


        if (in_array($file_actual_ext, $allowed)) {
            if ($file_error === 0) {
                if ($file_size < 500000) {
                    $file_nameNew = uniqid('', true) . "." . $file_actual_ext;
                    $file_destination = 'uploads/' . $file_nameNew;
                    move_uploaded_file($file_temporary_name, $file_destination);

                } else {
                    echo 'Your file is too big';
                }
            } else {
                echo 'There was an error uploading yur file';
            }
        } else {
            echo 'You cannot upload files of this type';
        }
    }
}
else{
    header('location: index.php?v=home');
}
?>


<form method="POST" class="form-horizontal" enctype="multipart/form-data">
 <div class="form-group">
   <div for="" class="col-md-4 control-label">
     <label for="male">Password</label>
   </div>
  <div class="col-md-4">

    <input type="text">
  </div>
 </div>
  <div class="form-group">
    <div class="col-md-4 control-label">
      <label for="photo">Update photo</label>
    </div>
  <div class="col-md-4 ">
    <input type="file" name="file" >
  </div>
  </div>
  <div class="form-group">
  <div class="col-md-6">

    <button name="submit">Upload image</button>
  </div>
  </div>
</form>
