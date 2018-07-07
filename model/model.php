<?php

class Manager
{


    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, author, signalement, jaime, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM texte ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getTheme()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM themeJour ORDER BY creation_date DESC LIMIT 0, 1');

        return $req;
    }

    public function getVidT()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM vidjour ORDER BY creation_date DESC LIMIT 0, 1');

        return $req;
    }
/*
    public function getUserPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM texte WHERE author="aaa" ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
        
    }
*/

    public function getUserPosts($pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, author, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM texte WHERE author= ? ORDER BY creation_date DESC LIMIT 0, 5');
            $req->execute(array($pseudo));

        return $req;
        
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, author, content, signalement, jaime, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM texte WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, signalement, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM commentaires WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }


    public function getCommentsTheme($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, signalement, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM themecomment WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function getCommentsVid($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, signalement, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM vidcomment WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }
    /*public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO commentaires (post_id, author, comment, comment_date) VALUES(:post_id, :author, :comment, NOW())');
        $affectedLines = true;
        $comments->execute(array(
        'post_id' => $postId,
        'author' => $author,   
        'comment' => $comment  
        ));
        return $affectedLines;
    }*/

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO `commentaires` (`id`, `post_id`, `author`, `comment`, `comment_date`, `signalement`) VALUES (NULL, :post_id, :author, :comment, CURRENT_TIMESTAMP, "non")'); 
        $affectedLines = true;
        $comments->execute(array(
        'post_id' => $postId,
        'author' => $author,   
        'comment' => $comment  
        ));
        return $affectedLines;
    }

    public function themeComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO `themecomment` (`id`, `post_id`, `author`, `comment`, `comment_date`, `signalement`) VALUES (NULL, :post_id, :author, :comment, CURRENT_TIMESTAMP, "non")'); 
        $affectedLines = true;
        $comments->execute(array(
        'post_id' => $postId,
        'author' => $author,   
        'comment' => $comment  
        ));
        return $affectedLines;
    }

    public function vidComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO `vidcomment` (`id`, `post_id`, `author`, `comment`, `comment_date`, `signalement`) VALUES (NULL, :post_id, :author, :comment, CURRENT_TIMESTAMP, "non")'); 
        $affectedLines = true;
        $comments->execute(array(
        'post_id' => $postId,
        'author' => $author,   
        'comment' => $comment  
        ));
        return $affectedLines;
    }

    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM commentaires WHERE id= :id');
        $req->execute(array(
        'id' => $id    
        ));
    }

    /*public function insertPost($title,$content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO texte (title, content, creation_date) VALUES (:title, :content, NOW())');
        $req->execute(array(
        'title' => $title,
        'content' => $content    
        ));
            
    }*/


    public function insertPost($title,$content,$author)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO `texte` (`id`, `title`, `content`, `creation_date`, `author`, `signalement`, `jaime`) VALUES (NULL, :title, :content, CURRENT_TIMESTAMP, :author, "non", 0)');
        $req->execute(array(
        'title' => $title,
        'content' => $content,
        'author' => $author   
        ));
    }

    public function insertTheme($content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO `themeJour` (`id`, `content`, `creation_date`) VALUES (NULL, :content, CURRENT_TIMESTAMP)');
        $req->execute(array(
        'content' => $content   
        ));
    }

    public function insertVidT($content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO `vidjour` (`id`, `content`, `creation_date`) VALUES (NULL, :content, CURRENT_TIMESTAMP)');
        $req->execute(array(
        'content' => $content   
        ));
    }


    public function UptdatePost($title, $content, $id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE texte SET title = :nvtitle, content = :nvcontent WHERE id= :id');
        $req->execute(array(
        'nvtitle' => $title,
        'nvcontent' => $content,
        'id' => $id
        ));    
    }

    public function Signalement($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE commentaires SET signalement = \'oui\' WHERE id= :id');
        $req->execute(array(
        'id' => $id
        ));    
    }

    public function SignalementPost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE texte SET signalement = \'oui\' WHERE id= :id');
        $req->execute(array(
        'id' => $id
        ));    
    }


    public function updateLike($nbrlikes, $id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE texte SET jaime = :nbrlikes WHERE id=  :id');
        $req->execute(array(
        'nbrlikes' => $nbrlikes,
        'id' => $id
        ));    
    }

    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM texte WHERE id= :id');
        $req->execute(array(
        'id' => $id    
        ));
    }

    public function inscription($nom, $prenom, $pseudo, $pass, $email){
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO membres(nom, prenom, pseudo, pass, email, date_inscription) VALUES(:nom, :prenom, :pseudo, :pass, :email, NOW())');
            $req->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'pseudo' => $pseudo,
            'pass' => $pass,
            'email' => $email
        ));
    }

    public function getUser()
    {
        $db = $this->dbConnect();
        $user = $db->query('SELECT nom, pseudo, email, date_inscription FROM membres ORDER BY date_inscription DESC');    

        return $user;
    }

    public function verifUser($pseudo){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pass FROM membres WHERE pseudo = :pseudo');
        $req->execute(array(
        'pseudo' => $pseudo));
        $resultat = $req->fetch();
        return $resultat;    
    }

    public function verifPseudo($pseudo){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT pseudo FROM membres WHERE pseudo = :pseudo');
        $req->execute(array(
        'pseudo' => $pseudo));
        $resultat = $req->fetch();
        return $resultat;    
    }

    private function dbConnect()
    {
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=projet5;charset=utf8', 'root', '');
            return $db;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }




}