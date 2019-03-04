<?php 

require("config.php");



if(isset($_POST["delete"])) {

    $delete_id = mysqli_real_escape_string($connect, $_POST["delete_id"]);



    $query = "DELETE FROM blogposts WHERE id = {$delete_id}";



    if(mysqli_query($connect, $query)) {

        header("Location: " ."blog.php");

    } else {

        echo "Error: " .mysqli_error($connect);

    }



}

$id = mysqli_real_escape_string($connect, $_GET["id"]);



$query = "SELECT * FROM blogposts WHERE id =" .$id;

$result = mysqli_query($connect, $query);

$blogpost = mysqli_fetch_assoc($result);

mysqli_free_result($result);

mysqli_close($connect);



require("header.php"); ?>

<div class="container readmore">

    <a href="blog.php">GO BACK</a><br><br>

    <div class="panel">

        <div class="panel-heading">

            <p class="post_title"><?php echo $blogpost["title"]; ?></p>

        </div>

        <div class="panel-body">

            <small class="post_small">Created on <?php echo $blogpost["created_at"]; ?> by <i><?php echo $blogpost["author"]; ?></i></small><br>

            <p class="post_body"><?php echo $blogpost["body"]; ?></p><br>

        </div>

        <div class="buttons_section">

            <a href="editpost.php?id=<?php echo $blogpost["id"];?>" class="btn btn-primary editpost">Edit</a><br><br>

            <form style="display:block;" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                <input type="hidden" name="delete_id" value="<?php echo $blogpost['id'];?>">

                <input type="submit" name="delete" value="Delete" class="btn btn-danger editpost" >

            </form>

        </div>

    </div>   
    <div style="height:35vh;"></div>
</div>
</body>
</html>