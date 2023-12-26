<!-- Footer -->
<div id ="footer">
    <div class="container">
        <div class="row">
        <?php
    
    include "config.php";
    $sql = "SELECT * from settings";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {



    ?>
            <div class="col-md-12">
                <span><?php echo $row['footer-desc'] ?></a></span>
            </div>
            <?php  }}
            ?>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
