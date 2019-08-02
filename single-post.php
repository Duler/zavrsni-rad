
<?php
include('db.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon.ico">
    <title>Vivify Academy Blog - Homepage</title>

    <link rel="stylesheet" href="styles.css">
</head>
<body class="va-l-page va-l-page--single">

<?php include('header.php'); ?>

    <div class="va-l-container">
        <main class="va-l-page-content">

            <?php
                if (isset($_GET['post_id'])) {

                    // pripremamo upit
                    $sql = "SELECT * FROM posts WHERE id = {$_GET['post_id']}";
                    $statement = $connection->prepare($sql);

                    // izvrsavamo upit
                    $statement->execute();

                    $statement->setFetchMode(PDO::FETCH_ASSOC);

                    // punimo promenjivu sa rezultatom upita
                    $singlePost = $statement->fetch();                   

            ?>

                    <article class="va-c-article">
                        <header>
                            <h1><?php echo $singlePost['title'] ?></h1>                            

                            <!-- zameniti  datum i ime sa pravim imenom i datumom blog post-a iz baze -->
                            <div class="va-c-article__meta"><?php echo($singlePost['created_at']) ?> by <?php echo($singlePost['author']) ?> </div>
                        </header>

                        <!-- zameniti ovaj privremeni (testni) text sa pravim sadrzajem blog post-a iz baze -->
                        <div>
                            <?php echo($singlePost['body']) ?>
                        </div>
                        
                        <a href="delete-post.php?postId=<?php echo $_GET['post_id'] ?>"><button>Obrisi post</button></a>

                        <?php
                          $sqlComments ="SELECT * FROM comments 
                          
                          WHERE comments.post_id = {$_GET['post_id']}";

                          $statement2 = $connection->prepare($sqlComments);

                          $statement2->execute();

                          $statement2->setFetchMode(PDO::FETCH_ASSOC);

                          $comments = $statement2->fetchAll();
                             ?>
                        <?php 
                            foreach ($comments as $comment) {?>
                        <div class="comments">
                            <h3>comments</h3>

                            <!-- zameniti testne komentare sa pravim komentarima koji pripadaju blog post-u iz baze -->
                            <div class="single-comment">
                                <div>posted by: <strong><?php echo($comment['author']) ?></strong> on <?php echo($comment['created_at']) ?></div>
                                <div><?php echo($comment['text']) ?>
                                </div>
                            </div>
                            <?php }?>
                        </div>

                        <form action="create-comment.php" method="post">
                            <input type="text" name="author">
                            <textarea name="text"></textarea>
                            <input type="hidden" name="id" value="<?php echo $_GET['post_id'] ?>">
                            <input type="submit" value="Snimi komentar">
                        </form>
                    </article>

            <?php
                 } else {
                     echo('post_id nije prosledjen kroz $_GET');
                 }
            ?>

        </main>
        <?php include('sidebar.php'); ?>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>