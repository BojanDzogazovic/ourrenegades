<?php 

require("config.php");

if(isset($_POST["submit"])) {

    $update_id = mysqli_real_escape_string($connect, $_POST["update_id"]);

    $title = mysqli_real_escape_string($connect, $_POST["title"]);

    $author = mysqli_real_escape_string($connect, $_POST["author"]);

    $body = mysqli_real_escape_string($connect, $_POST["body"]);



    $query = "UPDATE blogposts SET

    title = '$title',

    author = '$author',

    body = '$body'

    WHERE id = {$update_id}";



    if(mysqli_query($connect, $query)) {

        header("Location: " ."blog.php");

    } else {

        echo "Error: " .mysqli_error($connect);

    }

}



$id = mysqli_real_escape_string($connect, $_GET["id"]);

$query = "SELECT * FROM blogposts WHERE id=" .$id;

$result = mysqli_query($connect, $query);

$blogpost = mysqli_fetch_assoc($result);

mysqli_free_result($result);

mysqli_close($connect);



require("header.php"); ?>

<div class="container">

    <h1 class="newpost">EDIT POST</h1>

    <a href="blog.php">GO BACK</a><br><br>

    <form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>">

        <div class="form-group">

            <label>Title:</label>

            <input type="text" name="title" value="<?php echo $blogpost["title"]; ?>" class="form-control nooutline">

        </div>

        <div class="form-group">

            <label>Author:</label>

            <input type="text" name="author" value="<?php echo $blogpost["author"]; ?>" class="form-control nooutline">

        </div>

        <div class="form-group">

            <label>Post:</label>

            <textarea type="text" name="body" class="form-control nooutline"><?php echo $blogpost["body"]; ?></textarea>

        </div>

        <input type="hidden" name="update_id" value="<?php echo $blogpost["id"]; ?>">

        <input type="submit" name="submit" value="Submit" class="btn btn-primary submit">

    </form>
    <div style="height:35vh;"></div>
</div>
</body>
</html>