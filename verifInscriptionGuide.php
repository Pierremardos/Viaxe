<?php
  session_start();
?>

<?php
include 'include/config.php';
include 'include/functions.php';

$i = 0;
$pseudo = $_POST['pseudo'];
$mail = $_POST['email'];
$firstName = $_POST['prenom'];
$lastName = $_POST['nom'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$age = $_POST['birthday'];
$gender = $_POST['gender'];
$languages = $_POST['langue'];
$phone = $_POST['telephone'];
$description = $_POST['description'];
$picture = "/Viaxe/images/guide/unknow.jpeg";


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


$champs=array('pseudo','email', 'prenom', 'nom', 'password','confirm','birthday','gender','langue');

foreach ($champs as $value) {
  if(!isset($_POST[$value]) || empty($_POST[$value]))
  {
    header("Location:inscription2.php?error=".$value);
    exit;

  }
}


// test de compte
//Vérification du pseudo
  $query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM GUIDE WHERE pseudo =:pseudo');
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

  $query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM GUIDE WHERE mail =:mail');
  $query->bindValue(':mail',$mail, PDO::PARAM_STR);
  $query->execute();
  $mail_free=($query->fetchColumn()==0)?1:0;
  $query->CloseCursor();

  if(!$mail_free)
  {
      $email_erreur1 = "Votre adresse email est déjà utilisée par un membre";
      $i++;
  }

  $query=$bdd->prepare('SELECT COUNT(*) AS nbr FROM CUSTOMER WHERE mail =:mail');
  $query->bindValue(':mail',$mail, PDO::PARAM_STR);
  $query->execute();
  $mailCustomer_free=($query->fetchColumn()==0)?1:0;
  $query->CloseCursor();

  if(!$mailCustomer_free)
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


  if ($i==0)
  {
 echo'<h1>Inscription terminée</h1>';
       echo'<p>Bienvenue '.stripslashes(htmlspecialchars($_POST['pseudo']));

 //Et on définit les variables de sessions
       $_SESSION['mail'] = $mail;
       $query->CloseCursor();

$req = $bdd->prepare('INSERT INTO GUIDE (mail, pseudo, firstName, lastName, age, gender, picture, password, phone, description, languages, diploma, isBanned)
 VALUES ( :mail, :pseudo, :firstName, :lastName, :age, :gender, :picture, :password, :phone, :description, :languages, :diploma, 0)');


$req->execute(array(
  "mail"=>$mail,
  "pseudo"=>$pseudo,
  "firstName"=>$firstName,
  "lastName"=>$lastName,
  "age"=>$age,
  "gender"=>$gender,
  "picture"=>$picture,
  "password"=>chiffer($password),
  "phone"=>$phone,
  "description"=>$description,
  "languages"=>$languages,
  "diploma"=>$_POST['diploma']
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
