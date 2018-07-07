
<?php ob_start(); ?>
<style>
  .space
  {
    margin-left: 50px;
  }
</style>
<div class="space">
    <form method="post" action="index.php?id=<?php echo $_GET['id'] ?>&action=modif">
        <p>
           <label for="titre">
          Titre
           </label>
           <br />           
           <input type="text" name="titre" value="<?php echo $post['title'] ?>">       
       </p>
       <p>
           <label for="texte">
          Texte
           </label>
           <br />           
           <textarea name="texte" id="texte" rows="10" cols="50" ><?php echo strip_tags($post['content']) ?></textarea>       
       </p>
       <p><input type="submit" name="ajouter"></p>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('templateBackend.php'); ?>