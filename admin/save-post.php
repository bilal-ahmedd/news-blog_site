<?php 

include "config.php";

if(isset($_FILES['fileToUpload'])) {
    $errors = array();
    
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_temp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
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


session_start();
$post_title = mysqli_real_escape_string($conn,$_POST['post_title']);
$post_desc = mysqli_real_escape_string($conn,$_POST['postdesc']);
$post_category = mysqli_real_escape_string($conn,$_POST['category']);
$date = date("d M, Y");
$author = $_SESSION['userid'];

$sql = "INSERT into post(title, description, category, post_date, author, post_img) values('{$post_title}', '{$post_desc}', '{$post_category}', '{$date}', {$author}, '{$file_name}');";

$sql .= "UPDATE category set post = post+1 WHERE category_id = {$post_category}";

if(mysqli_multi_query($conn, $sql)) {
    header("Location: http://localhost/news-blog_site/admin/post.php");
}else {
    echo "<div class='alert'> Query Failed </div>";
}

?>