<?php 
include 'config.php';

if(empty($_FILES['new-image']['name'])) {
    $file_name = $_POST['old-image'];
}else {
    $errors = array();
    
    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_temp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $extensions = array('jpeg,', 'jpg', 'png');

    if(in_array($file_ext, $extensions) === False )  {
        $errors[] = "Extension is invalid, upload jpeg, jpg, png";
    }

    if($file_size > 2097152) {
        $errors[] = "File size must be lower than 2mb ";
    }


    if(empty($errors) == true) {
        move_uploaded_file($file_temp,"upload/".$file_name); 
    }else {
        
            print_r($errors);
            die();
    }
}

$sql = "UPDATE post SET title = '{$_POST['post_title']}', description = '{$_POST['postdesc']}' , category = {$_POST['category']}, post_img = '{$file_name}' where post_id = {$_POST['post_id']};";

if($_POST['old_category'] != $_POST['category']) {
    $sql .= "UPDATE category set post = post - 1 WHERE category_id = {$_POST['old_category']};";
    $sql .= "UPDATE category set post = post + 1 WHERE category_id = {$_POST['category']};";
}

$result = mysqli_multi_query($conn, $sql);

if($result) {
header("Location: http://localhost/news-blog_site/admin/post.php");
}else {
    echo "Query Failed";
}

?>