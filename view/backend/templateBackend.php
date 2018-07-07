
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>admin</title>
  <link rel="stylesheet" href="public/css/templateback.css">
  <!-- <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script> -->
    <style type="text/css">
      body
      {
        
      }
    </style>
</head>
<body>
  <div class="contain">
    <div class="menu-back">
      <a href="index.php" class="item-menu-back">pense le monde</a>
      <em class="">
        Bonjour <?php
        if (isset($_COOKIE['pseudo'])){
                  echo $_COOKIE['pseudo'];
        }elseif (isset($_SESSION['pseudo'])){
                  echo $_SESSION['pseudo'];
        }  
        ?>                  
      </em>
    </div>
    <div class="menu-back">
      <a href="index.php" class="item-menu-back">Accueil</a>
      <a href="index.php?action=deconexion" class="item-menu-back">Déconnexion</a>
    </div>
  </div>
  <div class="menu-lat">
    <div class="contain-lateral">
      <?php
      if (isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == "admin" OR isset($_COOKIES['pseudo']) && $_COOKIES['pseudo'] == "admin")
      {
      ?>
      <div class="item-lateral">
        <a href="index.php?action=adminaccess">Backend</a>
      </div>
      <?php
      }else{ ?>
      <div class="item-lateral">
        <a href="index.php?action=useraccess">Mes publications</a>
      </div>
      <?php
      }
      ?>
      <div class="item-lateral">
        <a href="./index.php?action=createView">Ecrire un post</a>
      </div>
      <?php
      if (isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == "admin" OR isset($_COOKIES['pseudo']) && $_COOKIES['pseudo'] == "admin")
      {      
      ?>
      <div class="item-lateral">
        <a href="./index.php?action=createTheme">Ecrire theme du jour</a>
      </div>
      
      <div class="item-lateral">
        <a href="index.php?action=membreView">Membres</a>
      </div>
      <?php
      }
      ?>
    </div>
    <div class="">
      <?= $content ?>
    </div>
  </div>
</body>
</html>   