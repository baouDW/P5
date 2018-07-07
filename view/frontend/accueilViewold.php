<?php
$title = 'Accueil'; 
?>
<style>
  .lire-suite
  {
    color:blue;
    font-size: 0.7em;
    font-weight: bold;
  }
</style>

<?php ob_start(); ?>

<?php

while ($data = $posts->fetch())
{
?>    
    <div class="post-preview">
            <a href="index.php?id=<?= $data['id'] ?>&action=comm">
              <h2 class="post-title">
                <?= $data['title'] ?>
              </h2>
              <h3 class="post-subtitle">
                <p><?= substr($data['content'], 0, 200); ?><span class="lire-suite">...Lire la suite</span></p>
              </h3>
            </a>
            <p class="post-meta">Poster le <?= $data['creation_date_fr'] ?></p>
        </div>
        <hr>    
        
<?php
}
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>
<?php require('templateFront.html'); ?>