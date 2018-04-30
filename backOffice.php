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
	<head>
  		<meta charset="utf-8">
  		<meta name="" content="">
  		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
      <header>
<<<<<<< HEAD
        <div class="container">
          <div class="row">
            <div class="col-2">
              <nav class="navbar">
              </nav>
            </div>
            <div class="col-10">
            <nav class="navbar navbar-expand navbar-light fixed-top bg-light">
              <a class="navbar-brand" href="index.php"> Viaxe </a>
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="#">Customer</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Guide</a>
                </li>
                <li class="nav-item">
                 <a class="nav-link" href="graphics.php">Graphs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Jeudi</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
      <div>
=======
        <?php
          include('Navbar/NavbarAdmin.php');
        ?>
>>>>>>> 31712d805509abf4b707aaf2926c09b34b2ca315
      </header>
      <br>
      <br>
      <div class="container">
      <h1> Customer Manager </h1>
      <form method="POST" action="">
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="validationDefault01">Mail</label>
            <input type="mail" class="form-control" id="validationDefault01" placeholder="Mail" value="mail" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="validationDefault02">Pseudo</label>
            <input type="text" class="form-control" id="validationDefault02" placeholder="Pseudo" value="pseudo" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="validationDefaultUsername">Birthday</label>
            <div class="input-group">
              <div class="input-group-prepend">
              </div>
              <input type="date" class="form-control" id="validationDefaultUsername" required>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationDefault03">Gender</label>
            <input type="radio" class="form-control" id="validationDefault03" placeholder="Male" required>
            <input type="radio" class="form-control" id="validationDefault04" placeholder="Female" required>
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationDefault05">Phone</label>
            <input type="text" class="form-control" id="validationDefault05" placeholder="Number" required>
          </div>
          <div class="col-md-4 mb-3">
            <label for="validationDefault01">Level</label>
            <input type="text" class="form-control" id="validationDefault01" placeholder="Level" value="" required>
          </div>
        </div>
        <button class="btn btn-primary" type="submit">Submit form</button>
      </form>
      <h1> Costumer Table</h1>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Mail</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Birth</th>
            <th scope="col">Gender</th>
            <th scope="col">Banned</th>
            <th scope="col">Tools</th>
            <th scope="col">  </th>
          </tr>
        </thead>
        <?php backOffice();
        ?>
    </div>
    </body>
</html>
