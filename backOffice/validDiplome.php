<?php
  include '../include/config.php';
  include '../include/functions.php';
 	require_once "../include/functions.php";
  session_start();
  if($_SESSION['mail'] == 'quentin.clodion@gmail.com' | $_SESSION['mail'] =='jonasnizard@gmail.com' | $_SESSION['mail'] == 'thomas.ddt@hotmail.fr'){

  }
  else{
      header("location: ../index.php");
      exit;
  }
	?>

  <!DOCTYPE html>
  <html>
    <?php
      include('../Navbar/NavbarBackOffice.php');
    ?>
    </header>
    <br>
    <br>
    <div class="container">
        <div class="row">
          <h1> Guide en attente</h1>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Mail</th>
                  <th scope="col">Pseudo</th>
                  <th scope="col">Diplôme</th>
                  <th scope="col">Identité</th>
                  <th scope="col">Valid</th>
                  <th scope="col">Refuse</th>
                </tr>
              </thead>
            <?php backOfficeDip();
            ?>
            </div>
          </body>
  </html>
