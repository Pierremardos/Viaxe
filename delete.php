<?php
require_once "functions.php";
session_start();
deleteUser($_GET["Id"]);
header("location:backOffice.php");
