<?php
 	require_once "include/functions.php";

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
  <fieldset>

  <!-- Form Name -->
  <legend>Client</legend>

  <!-- Text input-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="client-name">Name</label>
    <div class="col-md-4">
    <input id="client-name" name="client-name" type="text" placeholder="your client's name" class="form-control input-md">
    <span class="help-block">Full name of your customer</span>
    </div>
  </div>

  <!-- Prepended text-->
  <div class="form-group">
    <label class="col-md-4 control-label" for="client-email">Email</label>
    <div class="col-md-4">
      <div class="input-group">
        <span class="input-group-addon">@</span>
        <input id="client-email" name="client-email" class="form-control" placeholder="yourname@yourdomain.com" type="text">
      </div>
      <p class="help-block">Email of your client</p>
    </div>
  </div>



  <!-- Multiple Radios -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="client-status">Client status</label>
    <div class="col-md-4">
    <div class="radio">
      <label for="client-status-0">
        <input type="radio" name="client-status" id="client-status-0" value="active" checked="checked">
        Active
      </label>
  	</div>
    <div class="radio">
      <label for="client-status-1">
        <input type="radio" name="client-status" id="client-status-1" value="inactive">
        Inactive
      </label>
  	</div>
    </div>
  </div>


  <!-- Button -->
  <div class="form-group">
    <label class="col-md-4 control-label" for="btn-save"></label>
    <div class="col-md-4">
      <button id="btn-save" name="btn-save" class="btn btn-success">Save</button>
    </div>
  </div>

  </fieldset>
  </form>


  	   </div>




  <!-- LIST -->
  <div class=col-md-12>

      <form id="form-list-client">
              <legend>List of clients</legend>

      <div class="pull-right">
          <a class="btn btn-default-btn-xs btn-primary"><i class="glyphicon glyphicon-refresh"></i> Refresh</a>
          <a class="btn btn-default-btn-xs btn-success"><i class="glyphicon glyphicon-plus"></i> New</a>
      </div>
      <table class="table table-bordered table-condensed table-hover">
          <thead>
              <tr>
                  <th>Email</th>
                  <td>Pseudo</td>
                  <th>Age</th>
                  <th>Gender</th>
                  <th>isBanned</th>
                  <th></th>
              </tr>

          </thead>
          <tbody id="form-list-client-body">
              <tr>
                <?php  backOffice();	?>  
              </tr>
          </tbody>
      </table>
      </form>


    </div>
    </div>
    </div>
