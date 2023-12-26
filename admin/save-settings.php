<?php 
include 'config.php';

if(empty($_FILES['logo']['name'])) {
    $file_name = $_POST['old-logo'];
}else {
    $errors = array();
    
    $file_name = $_FILES['logo']['name'];
    $file_size = $_FILES['logo']['size'];
    $file_temp = $_FILES['logo']['tmp_name'];
    $file_type = $_FILES['logo']['type'];
    $exp = explode('.', $file_name);
    $file_ext = strtolower(end($exp));
    $extensions = array('jpeg,', 'jpg', 'png');

    if(in_array($file_ext, $extensions) === False )  {
        $errors[] = "Extension is invalid, upload jpeg, jpg, png";
    }

    if($file_size > 2097152) {
        $errors[] = "File size must be lower than 2mb ";
    }

    if(empty($errors) == true) {
        move_uploaded_file($file_temp,"images/".$file_name); 
    }else {
        
            print_r($errors);
            die();
    }
}

// Use prepared statements to update the database
$sql = "UPDATE settings SET `website-name` = ?, logo = ?, `footer-desc` = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sss", $_POST['website-name'], $file_name, $_POST['footer-desc']);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        header("Location: http://localhost/news-blog_site/admin/settings.php");
    } else {
        echo "Query Failed";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Statement preparation failed";
}

?>