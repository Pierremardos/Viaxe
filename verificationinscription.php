<?php
session_start();
include('Navbar.php');
include 'include/config.php';
include 'include/functions.php';

// on recup les donnée
	$i = 0;
	$pseudo=$_POST['pseudo'];
	$email = $_POST['email'];
	$country = $_POST['country'];
	$password = $_POST['password'];
	$birthday = $_POST['birthday'];
	$gender = $_POST['gender'];
	$telephone = $_POST['telephone'];
	$confirm = $_POST['confirm'];




	$champs=array('pseudo','email','password','confirm','birthday','gender','country');

	foreach ($champs as $value) {
		if(!isset($_POST[$value]) || empty($_POST[$value]))
		{
			header("Location:inscription.php?error=".$value);
			exit;

		}
	}

	// Ecriture du log
	$log=fopen("log.txt", "r+");
	fseek($log, 0, SEEK_END);
	fputs($log,"\n Création : \n");
	fputs($log,$_POST['pseudo']."\n");
  fputs($log,$_POST['password']."\n");

	// test de compte
	//Vérification du pseudo
    $query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM CUSTOMER WHERE pseudo =:pseudo');
    $query->bindValue(':pseudo',$pseudo, PDO::PARAM_STR);
    $query->execute();
    $pseudo_free=($query->fetchColumn()==0)?1:0;
    $query->CloseCursor();
    if(!$pseudo_free)
    {
        $pseudo_erreur1 = "Votre pseudo est déjà utilisé par un membre";
        $i++;
    }

    else if (strlen($pseudo) < 5 || strlen($pseudo) > 30)
    {
        $pseudo_erreur2 = "Votre pseudo n'a pas une taille comprise entre 5 et 30 caractères";
        $i++;
    }
    //Vérification du mdp
    if ($password != $confirm || empty($confirm) || empty($password))
    {
        $mdp_erreur = "Votre mot de passe et votre confirmation diffèrent ! ";
        $i++;
    }


		//Test de l'email

	//Il faut que l'adresse email n'ait jamais été utilisée
	$query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM CUSTOMER WHERE mail =:mail');
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

/*
		//Message
	$message = "Je te souhaite la bienvenu sur Viaxe, visite bien";
	//Titre
	$titre = "Bienvenue sur viaxe";

	mail($_POST['email'], $titre, $message);*/
	if ($i==0)
	{
 echo'<h1>Inscription terminée</h1>';
			 echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['pseudo']));

 //Et on définit les variables de sessions
			 $_SESSION['pseudo'] = $pseudo;
			 $_SESSION['level'] = 1;
			 $query->CloseCursor();

			 //bdd

			 $req = $bdd->prepare('INSERT INTO CUSTOMER (mail, pseudo, age, gender, password, phone)
				VALUES ( :mail, :pseudo, :birthday, :gender, :password, :phone)');


			 $req->execute(array(
				 "mail"=>$email,
				 "pseudo"=>$pseudo,
				 "birthday"=>$birthday,
				 "gender"=>$gender,
				 "password"=>$password,
				 "phone"=>$telephone
				 ));
	 }
	 else
	 {
			 echo'<h1>Inscription interrompue</h1>';
			 echo'<p>Une ou plusieurs erreurs se sont produites pendant l incription</p>';
			 echo'<p>'.$i.' erreur(s)</p>';
			 if (isset($pseudo_erreur1)){
			 		echo'<p>'.$pseudo_erreur1.'</p>';
		 		}
			 if (isset($pseudo_erreur2)){
			 		echo'<p>'.$pseudo_erreur2.'</p>';
		 		}
			 if (isset($mdp_erreur)){
			 		echo'<p>'.$mdp_erreur.'</p>';
		 		}
			 if (isset($email_erreur1)){
			 		echo'<p>'.$email_erreur1.'</p>';
		 		}
			 if (isset($email_erreur2)){
			 		echo'<p>'.$email_erreur2.'</p>';
		 		}
	 }

	//header("Location:index.php");
	exit;
?>
