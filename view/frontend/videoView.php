
<?php ob_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    
    <title>Video du jour</title>
     
    <style type="text/css">
      #player
      {
        justify-content: center;
      }
      #player
      {
        margin-left: 25%;
      }
      .space
      {
        margin-left: 27%;
      }
      .commentaire
      {
      margin:auto;      
      margin-top: 100px;
      border: solid;
      width: 70%;
      }
      .media
      {
        margin-left: auto;
      }
      .page-title
      {
        justify-content: 
      }
      h1
      {
        text-align: center;
      }
    </style>  
  </head>
  <body>

  <h1 class="page-title">La video du jour</h1>
  <div class="container">
    <div class="row theme-j">
      <div class="col-lg-12 citation">
        <?php
        while ($videot = $vidT->fetch())
        {
        ?>    
         <div class="space">                        
            <p>
              <?= nl2br($videot['content']) ?>            
            </p>
        </div> 
      </div>
    </div>
      <div class= "col-lg-6" id="player"></div>

    <div class="row commentaire">
      <div class="col-lg-12 ">commentaire
        <form action="./index.php?action=addvidComment&amp;id=<?= $videot['id'] ?>" method="post">
          <?php
          $vidcomm=$manager->getCommentsVid($videot['id']);
          }
          ?>
          <div class="form-group">
              <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
    <hr>
    <?php
    while ($comment = $vidcomm->fetch())
    {
    ?>
    <!-- Single Comment -->
    <div class="media mb-4">
      <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
      <div class="media-body">
        <h5 class="mt-0"><?= htmlspecialchars($comment['author']) ?></h5>
        <?= nl2br(htmlspecialchars($comment['comment'])) ?>
      </div>
    </div>
      <?php
      }
      ?>
    </div>
    <script src="public/js/youtube_api.js"></script>
  </body>
</html>
<?php $content = ob_get_clean(); ?>
<?php require('templateFront.html'); ?>