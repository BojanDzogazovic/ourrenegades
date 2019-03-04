<?php

require("config.php");



if(isset($_POST["submit"])) {

    $title = mysqli_real_escape_string($connect, $_POST["title"]);

    $author = mysqli_real_escape_string($connect, $_POST["author"]);

    $body = mysqli_real_escape_string($connect, $_POST["body"]);



    $query = "INSERT INTO blogposts(title, body, author) VALUES ('$title','$body','$author')";



    if(mysqli_query($connect, $query)) {

        header("Location: " ."blog.php");

    } else {

        echo "Error: " .mysqli_error($connect);

    }

}



require("header.php"); ?>

<div class="container">

    <h1 class="newpost">ADD NEW POST</h1>

    <a href="blog.php">GO BACK</a><br><br>

    <form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>">

        <div class="form-group">

            <label>Title:</label>

            <input type="text" name="title" class="form-control">

        </div>

        <div class="form-group">

            <label>Author:</label>

            <input type="text" name="author" class="form-control">

        </div>

        <div class="form-group">

            <label>Post:</label>

            <textarea type="text" name="body" class="form-control"></textarea>

        </div>

        <input type="submit" name="submit" value="Submit" class="btn btn-primary submit">

    </form>
    <div style="height:35vh;"></div>
</div>
</body>
</html>
