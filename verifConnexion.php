<?php
// include
include 'include/config.php';
include 'include/functions.php';
session_start();
include('Navbar.php');
?>

<?php
    $message='';
    $mail=$_POST['mail'];
    $password=$_POST['password'];

    if (empty($mail) || empty($password) )
    {
        $message = "Une erreur s est produite pendant votre identification.
	Vous devez remplir tous les champs";
    }
    else //On check le mot de passe
    {
        $query=$bdd->prepare('SELECT password
        FROM GUIDE WHERE mail = :mail');
        $query->bindValue(':mail',$mail, PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();

	       if ($password == $data['password'])
	       {
	           $_SESSION['mail'] = $mail;
	           $message = 'Bienvenue
			       vous êtes maintenant connecté!';
	       }
	       else // Acces pas OK !
	       {
           $query=$bdd->prepare('SELECT password
           FROM CUSTOMER WHERE mail = :mail');
           $query->bindValue(':mail',$mail, PDO::PARAM_STR);
           $query->execute();
           $data=$query->fetch();

           if ($password == $data['password'])
           {
             $_SESSION['mail'] = $mail;
             $message = 'Bienvenue vous êtes maintenant connecté!';
           }

           else // Acces pas OK !
           {
             $message = 'Une erreur s est produite pendant votre identification, le mot de passe ou l adresse mail
              entré n est pas correct.';
           }
	       }
         $query->CloseCursor();
    }
    echo'<p> <br> <br> <br>'.$message.'</p>';
?>
