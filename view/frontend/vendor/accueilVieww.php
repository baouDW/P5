<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap 3 Responsive Layout Example</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style type="text/css">

    .header-acc
    {
        border: solid;
        margin-left:20px;
        margin-right:20px;
        margin-bottom: 70px;
    }
    .post
    {
        text-align: center;
        
        display: flex;
        justify-content: space-around;
    }
    .post1
    {
        border: solid;
        width: 100%;
        margin-left:50px;
        margin-right:50px;
    }

</style>
<body>
<?php ob_start(); ?>

    <div class="header-acc">
        <h1>Post du jour</h1>
        <p>In today's world internet is the most popular way of connecting with the people. At <a href="https://www.tutorialrepublic.com" target="_blank">tutorialrepublic.com</a> you will learn the essential of web development technologies along with real life practice example, so that you can create your own website to connect with the people around the world.</p>
        <p><a href="https://www.tutorialrepublic.com" target="_blank" class="btn btn-success btn-lg">Lire la suite</a></p>
    </div>

    <?php
    while ($data = $posts->fetch())
    {
    ?>
    <div class="post">
    
        <div class="post1">
            <h2><?= $data['title'] ?></h2>
            <p><?= substr($data['content'], 0, 100); ?><a href="index.php?id=<?= $data['id'] ?>&action=comm" >....Lire la suite &raquo;</a></p>
        </div> 
          
    </div>
    <hr>
    
    <?php
    }
    $posts->closeCursor();
    ?> 

    <?php $content = ob_get_clean(); ?>
    <?php require('templateF.html'); ?>
    <div class="row">
        <div class="col-sm-12">
            <footer>
                <p></p>
            </footer>
        </div>
    </div>


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>                            