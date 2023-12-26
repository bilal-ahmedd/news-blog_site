<?php 
include 'header.php';
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading"> Website Settings</h1>
            </div>

            <div class="col-md-offset-3 col-md-6">
                <!-- Form -->

                <?php
    
    include "config.php";
    $sql = "SELECT * from settings";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {



    ?>
                <form action="save-settings.php" method="Post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="website-name"> Website Name </label>
        <input type="text" name="website-name" class="form-control" value="<?php echo $row['website-name'] ?>">
    </div>

    <div class="form-group">
        <label for="logo"> Logo </label>
        <input type="file" name="logo">
        <img src="images/<?php echo $row['logo'] ?>" alt="" width="150">
        <input type="hidden" name="old-logo" value="<?php echo $row['logo'] ?>">
    </div>

    <div class="form-group">
        <label for="footer-desc"> Footer Description </label>
        <textarea name="footer-desc" class="form-control" id="" cols="30" rows="10">  <?php echo $row['footer-desc'] ?>
    </textarea>
    </div>

    <input type="submit" name="submit" class="btn btn-success">
                </form>
    <?php 
    }
}
    ?>
            </div>
        </div>
    </div>
</div>