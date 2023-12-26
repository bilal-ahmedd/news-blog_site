<?php 
if($_SESSION['user_role'] == 0) {
    header("Location: http://localhost/news-blog_site/admin/post.php");
  }
  
include "config.php";

$catid = $_GET['id'];
$sql = "DELETE from category where category_id = '$catid' " ;

if(mysqli_query($conn, $sql)) {
    header("Location: http://localhost/news-blog_site/admin/category.php");
}else {
    echo " Category Do not DELETE ";
}

?>