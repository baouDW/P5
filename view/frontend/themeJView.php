<?php
//require('././model/model.php');
//$manager = new Manager();
//$theme= $manager->getTheme();
//$themeCom=$manager->getCommentsTheme($data['id']);
ob_start();
?>


<style type="text/css">
    body
    {
    	background-color: #5c3c3c;
    }
    .container
    {
    	border-color: red;
    }
    .theme-j
    {
    	text-align: center;
    	margin-bottom: 50px;
    	border: solid;
    	width: 100%;
    	margin: auto;
      background-color: white;
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
      h1
      {
        text-align: center;
      }
</style>
</head>
<body>
  <h1>Theme du jour</h1>
	<div class="container">
		<div class="row theme-j">
			<div class="col-lg-12 citation">
    <?php
    while ($data = $theme->fetch())
    {
    ?>    
     <div class="space">                       
        <p>
            <?= nl2br($data['content']) ?>            
        </p>
    </div> 
	 <?php
	//$themeCom=$manager->getCommentsTheme($data['id']);
	//}
	//$theme->closeCursor();
	//$themeCom=$manager->getCommentsTheme($data['id']);

	?>
			</div>
		</div>

		<div class="row commentaire">
			<div class="col-lg-12 ">commentaire
				<form action="./index.php?action=addthemeComment&amp;id=<?= $data['id'] ?>" method="post">
					<?php
					$themeCom=$manager->getCommentsTheme($data['id']);
					}
					//$theme->closeCursor();
					//$themeCom=$manager->getCommentsTheme($data['id']);
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
          while ($comment = $themeCom->fetch())
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
          
          
          
<?php $content = ob_get_clean(); ?>
<?php require('templateFront.html'); ?>
</body>


