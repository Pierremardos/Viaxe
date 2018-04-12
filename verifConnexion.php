<?php
// include
include 'include/config.php';
include 'include/functions.php';
session_start();
?>

<?php
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

	       if (chiffer($password) == $data['password'])
	       {
	           $_SESSION['mail'] = $mail;
             header("Location:index.php");
             exit;
	       }
	       else // Acces pas OK !
	       {
           $query=$bdd->prepare('SELECT password
           FROM CUSTOMER WHERE mail = :mail');
           $query->bindValue(':mail',$mail, PDO::PARAM_STR);
           $query->execute();
           $data=$query->fetch();

           if (chiffer($password) == $data['password'])
           {
             $_SESSION['mail'] = $mail;
             header("Location:index.php");
             exit;
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
