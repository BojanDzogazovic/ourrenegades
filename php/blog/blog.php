<?php 

require("config.php");

$query = "SELECT * FROM blogposts ORDER BY created_at DESC";

$result = mysqli_query($connect, $query);

$blogposts = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);



mysqli_close($connect);



require("header.php");?>

<div class="text-center">
    <p class="title">The Renegades Blog</p>
    <a href="addpost.php" class="btn addpost">+ Add post</a>      
</div>

<div class="container">

    <?php foreach($blogposts as $blogpost): ?>

    <div class="panel">

        <div class="panel-heading">

            <p class="post_title invert"><?php echo $blogpost["title"]; ?></p>

        </div>

        <div class="panel-body">

            <small class="post_small invert">Created on <?php echo $blogpost["created_at"]; ?> by <i><?php echo $blogpost["author"]; ?></i></small><br>

            <p class="post_body invert"><?php echo $blogpost["body"]; ?></p><br>

            <strong class="invert"><a href="post.php?id=<?php echo $blogpost["id"]; ?>">Edit post...</a></strong>

        </div>

    </div>

    <?php endforeach; ?>

</div>    
</body>
</html>

