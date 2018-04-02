<?php
// include
include 'include/config.php';
include 'include/functions.php';
session_start();
include('Navbar.php');
?>

<?php
    $message='';
    if (empty($_POST['mail']) || empty($_POST['password']) )
    {
        echo $message = "une erreur s est produite pendant votre identification.
	Vous devez remplir tous les champs";
    }
    else //On check le mot de passe
    {
        $query=$bdd->prepare('SELECT password, mail
        FROM GUIDE WHERE mail = :mail');
        $query->bindValue(':mail',$_POST['mail'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();

	if ($data['password'] == chiffer($_POST['password']))
	{
	    $_SESSION['mail'] = $data['mail'];
	    $message = 'Bienvenue
			vous êtes maintenant connecté!';
	}
	else // Acces pas OK !
	{
	    echo $message = 'Une erreur s est produite
	    pendant votre identification, le mot de passe ou l adresse mail
            entré n est pas correct.';
	}
    $query->CloseCursor();
    }

      echo '<p>'.$message.'</p>';

?>
