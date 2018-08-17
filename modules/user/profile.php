<?php
if (isset($_POST['submit']))
{
    $file = $_FILES['file'];
    $file_name = $_FILES['file']['name'];
    $file_type = $_FILES['file']['type'];
    $file_size = $_FILES['file']['size'];
    $file_error = $_FILES['file']['error'];
    $file_temporary_name = $_FILES['file']['tmp_name'];

$file_ext = explode('.', $file_name);
$file_actual_ext = strtolower(end($file_ext));

$allowed = array('jpg', 'jpeg', 'png');


    if (in_array($file_actual_ext, $allowed))
    {
        if ($file_error ===0){
            if ($file_size < 500000)
            {
            $file_nameNew = uniqid('', true). ".".$file_actual_ext;
            $file_destination = 'uploads/'.$file_nameNew;
            move_uploaded_file($file_temporary_name, $file_destination);

            } else{
                echo 'Your file is too big';
            }
        } else{
            echo 'There was an error uploading yur file';
        }
    } else {
            echo 'You cannot upload files of this type';
    }
}

?>


<form method="POST" enctype="multipart/form-data">

    <input type="file" name="file" >
    <button name="submit">Upload image</button>
</form>
