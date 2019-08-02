
<?php
include("db.php");
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
<body class="va-l-page va-l-page--homepage">

    <?php include('header.php') ?>

    <div class="va-l-container">
        <main class="va-l-page-content">

            <?php include("posts.php") ?>


            <div class="va-c-paginator">
                <a href="index.html" title="All posts">All posts</a>
            </div>
        </main>
    </div>

    <?php include('footer.php'); ?>

</body>
</html>