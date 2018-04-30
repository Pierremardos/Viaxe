<?php
// include
include 'include/config.php';
include 'include/functions.php';
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Role</title>
  </head>
  <header>
  <body>
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
  </header>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">Connexion :</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-4">
          <form method="post" action="verifConnexion.php">
            <div class="form-group w-50">
              <label>Adresse Mail :</label>
              <input type="text" class="form-control" name="mail">
              <small class="form-text text-muted"></small>
            </div>
            <div class="form-group">
              <label>Mot de Passe :</label>
              <input type="password" class="form-control w-50" name="password"> </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 bg-primary">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center">Inscription :</h1>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 align-self-center">
          <a href="inscription2.php">
          <img class="img-fluid d-block" src="images/utiles/guide.png">
          <h3 class="my-3 text-center">Guide</h3>
          </a>
          <p class="">Créer un compte guide permet de mettre en ligne des parcours partout dans le monde afin de les proposer aux clients. N'importe qui peut faire des parcours culinaires mais pour faire un parcours culturel dans des lieux publics, il faut disposer
            d'un diplôme qu'il faudra nous envoyer.</p>
        </div>
        <div class="col-md-6 align-self-center">
          <a href="inscription.php">
          <img class="img-fluid d-block" src="images/utiles/customer.png">
          <h3 class="my-3 text-center">Client</h3>
          </a>
          <p class="">Créer un compte client permet d'avoir accès à l'ensemble des parcours et de réserver des places pour une à plusieurs personnes. Il peut aussi noter un parcours auquel il a déjà participé. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
