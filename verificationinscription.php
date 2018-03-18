<?php
include 'include/config.php';

// on recup les donnée
	$i = 0;
	$pseudo=$_POST['pseudo'];
	$email = $_POST['email'];
	$country = $_POST['country'];
	$pass = ($_POST['password']);
	$confirm = ($_POST['confirm']);




	$champs=array('pseudo','email','password','confirm','birthday','gender','country','role');

	foreach ($champs as $value) {
		if(!isset($_POST[$value]) || empty($_POST[$value]))
		{
			header("Location:inscription.php?error=".$value);
			exit;

		}
	}
	// include
	include 'include/config.php';
	include 'include/function.php';
	// Ecriture du log
	$log=fopen("log.txt", "r+");
	fseek($log, 0, SEEK_END);
	fputs($log,$_POST['pseudo']."\n");
  fputs($log,$_POST['password']."\n");

	// test de compte
	//Vérification du pseudo
    $query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM user WHERE pseudo =:pseudo');
    $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
    $query->execute();
    $pseudo_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    if(!$pseudo_free)
    {
        $pseudo_erreur1 = "Votre pseudo est déjà utilisé par un membre";
        $i++;
    }

    if (strlen($pseudo) < 3 || strlen($pseudo) > 15)
    {
        $pseudo_erreur2 = "Votre pseudo est soit trop grand, soit trop petit";
        $i++;
    }

    //Vérification du mdp
    if ($pass != $confirm || empty($confirm) || empty($pass))
    {
        $mdp_erreur = "Votre mot de passe et votre confirmation diffèrent ! ";
        $i++;
    }



		//Test de l'email

	//Il faut que l'adresse email n'ait jamais été utilisée
	$query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM user WHERE email =:mail');
	$query->bindValue(':mail',$email, PDO::PARAM_STR);
	$query->execute();
	$mail_free=($query->fetchColumn()==0)?1:0;
	$query->CloseCursor();

	if(!$mail_free)
	{
			$email_erreur1 = "Votre adresse email est déjà utilisée par un membre";
			$i++;
	}
	//On vérifie la forme maintenant
	if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $email) || empty($email))
	{
			$email_erreur2 = "Votre adresse E-Mail n'a pas un format valide";
			$i++;
	}



	//bdd

	$req = $bdd->prepare("INSERT INTO USER (pseudo,email,password,birthday,gender,country,role) VALUES (:pseudo,:email,:password,:birthday,:gender,:country,:role)");
	$req -> execute (array(
												"pseudo"=>htmlspecialchars($_POST['pseudo']),
												"email"=>htmlspecialchars($_POST['email']),
												"password"=>chiffer($_POST['password']),
												"birthday"=>htmlspecialchars($_POST['birthday']),
												"gender"=>htmlspecialchars($_POST['gender']),
												"country"=>htmlspecialchars($_POST['country']),
												"role"=>htmlspecialchars($_POST['role'])));


		//Message
	$message = "Je te souhaite la bienvenu sur Viaxe, visite bien";
	//Titre
	$titre = "Bienvenue sur viaxe";

	mail($_POST['email'], $titre, $message);
	if ($i==0)
	{
 echo'<h1>Inscription terminée</h1>';
			 echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['pseudo']));


 //Et on définit les variables de sessions
			 $_SESSION['pseudo'] = $pseudo;
			 $_SESSION['id'] = $db->lastInsertId(); ;
			 $_SESSION['level'] = 2;
			 $query->CloseCursor();
	 }
	 else
	 {
			 echo'<h1>Inscription interrompue</h1>';
			 echo'<p>Une ou plusieurs erreurs se sont produites pendant l incription</p>';
			 echo'<p>'.$i.' erreur(s)</p>';
			 echo'<p>'.$pseudo_erreur1.'</p>';
			 echo'<p>'.$pseudo_erreur2.'</p>';
			 echo'<p>'.$mdp_erreur.'</p>';
			 echo'<p>'.$email_erreur1.'</p>';
			 echo'<p>'.$email_erreur2.'</p>';
			 echo'<p>'.$msn_erreur.'</p>';
			 echo'<p>'.$signature_erreur.'</p>';
			 echo'<p>'.$avatar_erreur.'</p>';
			 echo'<p>'.$avatar_erreur1.'</p>';
			 echo'<p>'.$avatar_erreur2.'</p>';
			 echo'<p>'.$avatar_erreur3.'</p>';
			 

			 echo'<p>Cliquez <a href="./register.php">ici</a> pour recommencer</p>';
	 }
}
	header("Location:index.php");
	exit;
?>
