<?php
include "Navbar/NavbarCustomer.php";
require_once "include/functions.php";
session_start();
echo'
  <br>
  <div class="container">
    <form method="POST" action="message.php" >
      <input type="text" value="" name="comment"/>
      <input type="hidden" value="'.$_SESSION["mail"].'" name="mail"/>
      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
  </div>
    ';
showMessageClient($_SESSION["mail"]);
?>
