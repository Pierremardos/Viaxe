<?php
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
	<head>
		<meta charset="utf-8">
		<meta name="" content="">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet" media="screen">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css" rel="stylesheet">

	</head>
  <div class="container">
  	<div class="row">
  <!-- FORM  -->
  	   <div class="col-md-12">

  	    <form class="form-horizontal" id="form-edit-client">







      <form id="form-list-client">
            <legend>List of clients</legend>
      <table class="table table-bordered table-condensed table-hover">
          <thead>
              <tr>
                  <th>Email</th>
                  <td>Pseudo</td>
                  <th>Age</th>
                  <th>Gender</th>
                  <th>isBanned</th>
              </tr>

          </thead>
          <tbody id="form-list-client-body">
              <tr>
                <?php
                backOffice();
                ?>

              </tr>
          </tbody>
      </table>
      </form>


    </div>
    </div>
    </div>
