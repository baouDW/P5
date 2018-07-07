<?php
session_start();



require('./model/model.php');

function accueil(){
	$manager = new Manager();
	$theme= $manager->getTheme();
	require('./view/frontend/accueilView.php');
}

function listPosts(){
	$manager = new Manager();
	$posts= $manager->getPosts();
	$theme= $manager->getTheme();
	require('./view/frontend/lastPenseeView.php');
}

function insertP(){
	$manager = new Manager();
	$insertPost= $manager->insertPost($_POST['titre'], $_POST['texte'], $_SESSION['pseudo']);	
	header('Location: ./index.php?action=createView');
}

function insertT(){
	$manager = new Manager();
	$insertTheme= $manager->insertTheme($_POST['texte']);	
	header('Location: ' . $_SERVER['HTTP_REFERER'] );
}

function addComment()
{
	$manager = new Manager();
    $affectedLines = $manager->postComment($_GET['id'], $_SESSION['pseudo'], $_POST['comment']);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
    	header('Location: ' . $_SERVER['HTTP_REFERER'] );
    }
}

function addthemeComment()
{
	$manager = new Manager();
    $affectedLines = $manager->themeComment($_GET['id'], $_SESSION['pseudo'], $_POST['comment']);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
    	header('Location: ' . $_SERVER['HTTP_REFERER'] );
    }
}


function addvidComment()
{
	$manager = new Manager();
    $affectedLines = $manager->vidComment($_GET['id'], $_SESSION['pseudo'], $_POST['comment']);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
    	header('Location: ' . $_SERVER['HTTP_REFERER'] );
    }
}

function updateView(){
	$manager = new Manager();
	$post= $manager->getPost($_GET['id']);
	require('./view/backend/updateView.php');
}

function createView(){
	$manager = new Manager();
	$posts= $manager->getPosts();
	require('./view/backend/createpostView.php');
}

function createTheme(){
	$manager = new Manager();
	$theme= $manager->getTheme();
	require('./view/backend/createthemeView.php');
}

function update(){
	$manager = new Manager();
	$update= $manager->UptdatePost($_POST['titre'], $_POST['texte'], $_GET['id']);
	header('Location: ./index.php?action=adminaccess');
}

function signal(){
	$manager = new Manager();
	$Signalement= $manager->Signalement($_GET['id']);
	header('Location: ' . $_SERVER['HTTP_REFERER'] );
}

function signalPost(){
	$manager = new Manager();
	$SignalementPost= $manager->SignalementPost($_GET['id']);
	//header('Location: ' . $_SERVER['HTTP_REFERER'] );
}

function delete(){
	$manager = new Manager();
	$delete= $manager->deletePost($_GET['id']);
	header('Location: ./index.php?action=adminaccess');
}

function posts(){
	$manager = new Manager();
	$post= $manager->getPost($_GET['id']);
	$comments= $manager->getComments($_GET['id']);
	require('./view/frontend/postVieww.php');
}

function themeV(){
	$manager = new Manager();
	$theme= $manager->getTheme();
	//$themeCom=$manager->getCommentsTheme($_GET['id']);
	require('./view/frontend/themeJView.php');
}

function videoView(){
	$manager = new Manager();
	$vidT= $manager->getVidT();
	require('./view/frontend/videoView.php');
}

function commentsAdmin(){
	$manager = new Manager();
	$post= $manager->getPost($_GET['id']);
	$comments= $manager->getComments($_GET['id']);
	require('./view/backend/commentView.php');
}

function membreView(){
	$manager = new Manager();
	$user = $manager->getUser();
	require('./view/backend/userView.php');
}

function delcomm(){
	$manager = new Manager();
	$delcomm= $manager->deleteComment($_GET['id']);
	header('Location: ' . $_SERVER['HTTP_REFERER'] );
}

function signup(){
	$manager = new Manager();
	$pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);

	$verifPseudo= $manager->verifPseudo($_POST['pseudo']);
	if ($verifPseudo)
		{          
    		
    		header('Location: view/frontend/signUpView.php?error=error');
		}
	else
		{
			$inscription= $manager->inscription($_POST['Nom'], $_POST['Prenom'], $_POST['pseudo'], $pass_hache, $_POST['email']);
			header('Location: ./index.php');
		}
	
}

function login(){
	$manager = new Manager();
	$posts= $manager->getPosts();
	$verifuser = $manager->verifUser($_POST['pseudo']);	
	$isPasswordCorrect = password_verify($_POST['pass'], $verifuser['pass']);
	

	if ((!$verifuser) OR (!$isPasswordCorrect))
	{
           
        header('Location: view/frontend/loginView.php?error=error');
	}
	else
	{
    	if (($isPasswordCorrect) && ($_POST['pseudo'] == 'admin') && (!isset($_POST['rapel']))){
    		session_destroy();
	        session_start();
	        $_SESSION['id'] = $verifuser['id'];
	        $_SESSION['pseudo'] = $_POST['pseudo'];
	        require('./view/backend/crudView.php');
	    }
	    elseif (($isPasswordCorrect) && ($_POST['pseudo'] == 'admin') && (isset($_POST['rapel']))) {
	    	setcookie('id', $verifuser['id'], time() + 365*24*3600, null, null, false, true); 
			setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
			require('/view/backend/crudView.php');
	    }
	    elseif (($isPasswordCorrect) && (!isset($_POST['rapel']))){
	    	session_start();
	        $_SESSION['id'] = $verifuser['id'];
	        $_SESSION['pseudo'] = $_POST['pseudo'];
	        header('Location: ./index.php');
	    }
	    elseif (($isPasswordCorrect) && (isset($_POST['rapel'])) && ($_POST['pseudo'] !== 'admin')) {
	    	setcookie('id', $verifuser['id'], time() + 365*24*3600, null, null, false, true); 
			setcookie('pseudo', $_POST['pseudo'], time() + 365*24*3600, null, null, false, true);
			header('Location: ./index.php');
	    }
	    else{
	    	throw new Exception('Mauvais identifiant ou mot de passe !!!');
	    }
	}
}

function adminaccess(){
	$manager = new Manager();
	$posts= $manager->getPosts();
	require('./view/backend/crudView.php');
}

function useraccess(){
	$manager = new Manager();
	$pseudoo=$_SESSION['pseudo'];
	$req= $manager->getUserPosts($pseudoo);
	require('./view/backend/userbackView.php');
}

function deconexion(){
		
	session_start();
	
	$_SESSION = array();
	session_destroy();
	
	setcookie('id', '');
	setcookie('pseudo', '');
	header('Location: ./index.php');
}

function updatejaime(){
	$manager = new Manager();
	$manager->updateLike($_GET['nbrjaime'], $_GET['id']);
	echo $_GET['nbrjaime'];	
}