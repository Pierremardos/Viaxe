<?php
session_start();
include 'include/config.php';
include 'include/functions.php';

// on recup les donnée
	$i = 0;
	$pseudo=htmlspecialchars($_POST['pseudo']);
	$mail = htmlspecialchars($_POST['email']);
	$country = $_POST['country'];
	$password = $_POST['password'];
	$birthday = $_POST['birthday'];
	$gender = $_POST['gender'];
	$telephone = htmlspecialchars($_POST['telephone']);
	$confirm = $_POST['confirm'];
	$picture = "/Viaxe/images/customer/unknow.jpeg";


	if(isset($_SESSION['mail'])){

		$query=$bdd->prepare('SELECT mail
		FROM GUIDE WHERE mail = :mail');
		$query->bindValue(':mail',$_SESSION['mail'], PDO::PARAM_STR);
		$query->execute();
		$data=$query->fetch();

		if($_SESSION['mail'] == 'quentin.clodion@gmail.com' | $_SESSION['mail'] =='jonasnizard@gmail.com' | $_SESSION['mail'] == 'thomas.ddt@hotmail.fr'){
			include('Navbar/NavbarAdmin.php');
		}
		else if ($_SESSION['mail'] == $data['mail'])
		 {
				 include('Navbar/NavbarGuide.php');
		 }
		 else{
			 include('Navbar/NavbarCustomer.php');
		 }
	}
	else{
		include('Navbar/Navbar.php');
	}



	$champs=array('pseudo','email','password','confirm','birthday','gender','country');

	foreach ($champs as $value) {
		if(!isset($_POST[$value]) || empty($_POST[$value]))
		{
			header("Location:inscription.php?error=".$value);
			exit;

		}
	}


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

    else if (strlen($pseudo) < 4 || strlen($pseudo) > 30)
    {
        $pseudo_erreur2 = "Votre pseudo n'a pas une taille comprise entre 4 et 30 caractères";
        $i++;
    }
    //Vérification du mdp
    if ($password != $confirm || empty($confirm) || empty($password))
    {
        $mdp_erreur = "Votre mot de passe et votre confirmation diffèrent ! ";
        $i++;
    }


		$min = strtotime($birthday);
	  $now = strtotime("now") + 7200;
	  if($now - $min < 0){
	   $i++;
	   $date_erreur1 = "Vous n'êtes pas encore né";
	  }
	  else if($now - $min > 3155760000){
	    $i++;
	    $date_erreur2 = "Nous avons limité l'age maximum à 100ans si vous avez vraielent cette âge veuillez mettre un plus jeune âge s'il vous plaît";
	  }
	  else if($now - $min < 157788000){
	    $i++;
	    $date_erreur3 = "Il faut avoir plus de 5ans pour créer un compte";
	  }

		//Test de l'email

	//Il faut que l'adresse email n'ait jamais été utilisée
	$query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM CUSTOMER WHERE mail =:mail');
	$query->bindValue(':mail',$mail, PDO::PARAM_STR);
	$query->execute();
	$mail_free=($query->fetchColumn()==0)?1:0;
	$query->CloseCursor();

	if(!$mail_free)
	{
			$email_erreur1 = "Votre adresse email est déjà utilisée par un membre";
			$i++;
	}

	$query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM GUIDE WHERE mail =:mail');
	$query->bindValue(':mail',$mail, PDO::PARAM_STR);
	$query->execute();
	$mailGuide_free=($query->fetchColumn()==0)?1:0;
	$query->CloseCursor();

	if(!$mailGuide_free)
	{
			$email_erreur1 = "Votre adresse email est déjà utilisée par un membre";
			$i++;
	}
	//On vérifie la forme maintenant
	if (!preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$#", $mail) || empty($mail))
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
			 $_SESSION['mail'] = $mail;
			 $_SESSION['level'] = 1;
			 $query->CloseCursor();

			 //bdd

			 $req = $bdd->prepare('INSERT INTO CUSTOMER (mail, pseudo, age, gender, picture, password, phone, level, isBanned)
				VALUES ( :mail, :pseudo, :birthday, :gender, :picture, :password, :phone, 100, 0)');


			 $req->execute(array(
				 "mail"=>$mail,
				 "pseudo"=>$pseudo,
				 "birthday"=>$birthday,
				 "gender"=>$gender,
				 "picture"=>$picture,
				 "password"=>chiffer($password),
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
				if (isset($date_erreur1)){
						echo'<p>'.$date_erreur1.'</p>';
					}
				if (isset($date_erreur2)){
						echo'<p>'.$date_erreur2.'</p>';
					}
				if (isset($date_erreur3)){
						echo'<p>'.$date_erreur3.'</p>';
					}
	 }

	//header("Location:index.php");
	//exit;
?>
