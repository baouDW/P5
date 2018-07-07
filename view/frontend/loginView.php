<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Identification</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style type="text/css">
    .login-form {
        width: 340px;
        margin: 50px auto;
    }
    .login-form form {
        margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
    .error
    {
        color: red;
    }
</style>
</head>
<body>
    <a href="../../index.php">Retour a l'accueil</a>
<div class="login-form">
    <form action="../../index.php?action=login" method="post">
        <h2 class="text-center">S'identifier</h2>       
        <div class="form-group">
            <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" required="">
        </div>
        <div class="form-group">
            <input type="password" name="pass" class="form-control" placeholder="Mot de passe" required="">
        </div>
        <?php
        if (isset($_GET['error']))
        {
        ?>
            <div class="error">Mauvais identifiant ou mot de passe</div>
        <?php
        }
        ?>   
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">S'identifier</button>
        </div>
        <div class="clearfix">
            <label class="pull-left checkbox-inline"><input type="checkbox" name="rapel"> Se rappeler de moi</label>
            
        </div>        
    </form>
    <p class="text-center"><a href="signUpView.php">Crée un compte</a></p>
</div>
</body>
</html>                                                                 