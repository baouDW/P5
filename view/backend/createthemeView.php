
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Ecrire un chapitre</title>
    <link rel="stylesheet" href="../public/css/tinycss.css">
    <script src="../public/js/editeur.js"></script> 
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>   
  </head>
  <body>
    <style>
      .space
      {
        margin-left: 50px;
      }
    </style>

<?php ob_start(); ?>

<div class="space">
    <form method="post" action="index.php?action=insertTheme">

        
        <p>
           <label for="titre">
          Titre
           </label>
           <br />           
           <input type="text" name="titre">       
       </p>
       
       <p>
           <label for="texte">
          Texte
           </label>
           <br />           
           <textarea name="texte" id="texte" rows="10" cols="50"></textarea>       
       </p>
       <p><input type="submit" name="ajouter" value="Ajouter un article"></p>
    </form>
</div>
<h2 class="space">Apercu des themes</h2>
<?php
while ($data = $theme->fetch())
{
?>    
     <div class="space">
        <h3>
           
        </h3>
                
        <p>
            <?= nl2br($data['content']) ?>            
        </p>
    </div> 
<?php
}
$theme->closeCursor();
?> 


<?php $content = ob_get_clean(); ?>
<?php require('templateBackend.php'); ?>

  </body>
</html>



