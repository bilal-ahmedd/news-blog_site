<?php include "header.php"; 
if($_SESSION['user_role'] == 0) {
    header("Location: http://localhost/news-blog_site/admin/post.php");
  }
  
if(isset($_POST['sumbit'])) {

    include 'config.php';

    $catid = mysqli_real_escape_string($conn, $_POST['cat_id']);
    $catname = mysqli_real_escape_string($conn, $_POST['cat_name'] );

    $sql3 = "SELECT * from category where category_name = '$catname' ";
    $result3 = mysqli_query($conn, $sql3) or die("Query Failed");

    if (mysqli_num_rows($result3) > 0) {

        echo "<p style='color:red; text-align;'> Category Exists </p>";

    } else {

        $sql2 = "UPDATE category SET category_name = '$catname' where category_id = '$catid' ";
        
        if(mysqli_query($conn, $sql2)) {
            header("Location: http://localhost/news-blog_site/admin/category.php");
        }else {
           echo "Update failed";
        }
        
    }

}
    
 





?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>


              <div class="col-md-offset-3 col-md-6">
<?php
              include 'config.php';
             $categoryid = $_GET['id'];
            $sql = "SELECT * from category where category_id = '$categoryid' ";
            $result = mysqli_query($conn, $sql );

            if(mysqli_num_rows($result) > 0 ) {

                while($row = mysqli_fetch_assoc($result)) {

?>
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id'] ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name'] ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>

                  <?php 
            }

            }
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
