<?php
  include '../include/config.php';
 	require_once "../include/functions.php";
  session_start();
  if($_SESSION['mail'] == 'quentin.clodion@gmail.com' | $_SESSION['mail'] =='jonasnizard@gmail.com' | $_SESSION['mail'] == 'thomas.ddt@hotmail.fr'){

  }
  else{
      header("location: ../index.php");
      exit;
  }
  include('../Navbar/NavbarBackOffice.php');
	?>

      <br>
      <br>
      <div class="container">
        <h1>Banned Guide Table</h1>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Mail</th>
              <th scope="col">Pseudo</th>
              <th scope="col">Birth</th>
              <th scope="col">Gender</th>
              <th scope="col">Unban</th>
            </tr>
          </thead>
          <?php showBannedCustomer();
          ?>
      </div>
    </body>
</html>
