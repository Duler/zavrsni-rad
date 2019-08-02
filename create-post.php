
<!doctype html>
<html lang="en">
<head>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="">
   <link rel="icon" href="../../../../favicon.ico">

   <title>Vivify Blog</title>

   
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

   <!-- Custom styles for this template -->   
   <link href="styles.css" rel="stylesheet">
</head>

<?php include('header.php')?>

<body>
    <main role="main" class="container">
    <?php
    include('db.php');
    $error = '';
    if ($_SERVER["REQUEST_METHOD"] === 'GET' && !empty($_GET['error'])) {
        $error = 'All fields are required!';
    }
    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        $author = $_POST['author'];
        $title = $_POST['title'];
        $post = $_POST['post'];

        $sqlInsert2 = "INSERT INTO posts (Title, body, author) VALUES ('$title', '$post', '$author')";
    
        $statement2 = $connection->prepare($sqlInsert2);
        $statement2->execute();

        header('Location: index.php');
    }
    ?>
        <form class="form" method="POST" action="create-post.php" >
    <?php if (!empty($error)) {?>
        <span class="alert alert-danger">
            <?php echo $error; ?>
        </span>
    <?php } ?>
        <input name="title" type="text" placeholder="Title" style="display:block; margin-bottom:1rem; padding:0.5rem">
        <textarea name="post" rows="5" cols="70" placeholder="Your post"  style="display:block; margin-bottom:1rem"></textarea>
        <input name="author" type="text" placeholder="Author"  style="display:block; margin-bottom:1rem; padding:0.5rem"/>
        <input class="btn btn-default" type="submit" value="Submit">
        </form>
    </main>
    <?php include('sidebar.php'); ?>

    <?php include('footer.php'); ?>
</body>
</html>

