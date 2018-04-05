<?php
require_once "include/functions.php";
session_start();
unbanUser($_GET["Id"]);
header("location: backOffice.php"); 
