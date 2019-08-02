<?php
    include('db.php');

    $sql = "DELETE FROM posts WHERE id={$_GET['postId']}";
    echo $sql;
    $statement = $connection->prepare($sql);
    $statement->execute();

    header("Location: single-post?post_id={$_GET['postId']}");
?>