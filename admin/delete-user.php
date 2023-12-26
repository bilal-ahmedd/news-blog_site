<?php

if($_SESSION['user_role'] == 0) {
    header("Location: http://localhost/news-blog_site/admin/post.php");
  }
  
include "config.php";

$userid = $_GET['id'];
$sql = "DELETE From user where user_id = {$userid}";


if(mysqli_query($conn, $sql)) {
    header("Location: http://localhost/news-blog_site/admin/users.php");
}else {
    echo "Row Does Not delete";
}

mysqli_close($conn);

?>