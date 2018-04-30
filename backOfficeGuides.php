<?php
  include 'include/config.php';
  include 'include/functions.php';
 	require_once "include/functions.php";
  session_start();
  if($_SESSION['mail'] == 'quentin.clodion@gmail.com' | $_SESSION['mail'] =='jonasnizard@gmail.com' | $_SESSION['mail'] == 'thomas.ddt@hotmail.fr'){

  }
  else{
      header("location: index.php");
      exit;
  }
	?>

<!DOCTYPE html>
<html>

        <?php
          include('Navbar/NavbarAdmin.php');
        ?>
      </header>
      <br>
      <br>
      <div class="container">
        <h1> Customer Manager </h1>
        <div class="row">
          <div class="col-md-6">
            <form method="POST" action="verifInscriptionGuide.php">
              <div class="form-group w-50">
                <label>Adresse Mail :</label>
                <input type="mail" class="form-control" name="email">
                <small class="form-text text-muted"></small>
              </div>
              <div class="form-group">
               <label>Pseudo :</label>
               <input type="text" class="form-control w-50" name="pseudo">
              </div>
              <div class="form-group">
                <label>Mot de Passe :</label>
                <input type="password" class="form-control w-50" name="password">
                </div>
              <div class="form-group">
               <label>Confirmez votre mot de passe :</label>
               <input type="password" class="form-control w-50" name="confirm">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Date de naissance:</label>
                <input type="date" name="birthday" placeholder="Date de naissance">
              </div>
              <div class="form-group">
               <label>Sexe :</label>
               <input type="radio" name="gender" value="1" checked> Homme
               <input type="radio" name="gender" value="2"> Femme
             </div>
             <div class="form-group">
               <label>Pays de résidence :</label>
               <input type="text" class="form-control w-50" name="country">
             </div>
             <div class="form-group">
               <label>Numéro de téléphone (Optionnel) :</label>
               <input type="text" class="form-control w-50" name="telephone">
             </div>
              <button type="submit" class="btn btn-primary">Inscription</button>
            </form>
          </div>
        </div>
      <h1> Costumer Table</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Mail</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Birth</th>
            <th scope="col">Gender</th>
            <th scope="col">Edit</th>
            <th scope="col">Ban</th>
          </tr>
        </thead>
        <?php backOfficeGuides();
        ?>
    </div>
    </body>
</html>
