
<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "vivify";
    $dbname = "blog";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
?>


<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
   
    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
</head>
<body>

        <div class="row">

            <div class="col-sm-8 blog-main">
            <?php

            $sql = "SELECT * FROM posts ORDER BY created_at DESC;";
            $statement = $connection->prepare($sql);

            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $posts = $statement->fetchAll();

                //echo '<pre>';
                //var_dump($posts);
                //echo '</pre>';

            ?>

            <?php
                foreach ($posts as $post) {
            ?> 
            <div class="blog-post">
                <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></h2>
                <p class="blog-post-meta"><?php echo($post['created_at']) ?> by <?php echo($post['author']) ?></p>
                <p><?php echo($post['body']) ?></p>
            </div><!-- /.blog-post -->
            <?php
                }
            ?> 
            <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>

            </div><!-- blog-main -->
            <?php include('sidebar.php')?>
        </div>

</body>
</html>


//posts.id, posts.title, posts.body, posts.author, posts.created_at