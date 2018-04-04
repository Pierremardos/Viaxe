<?php
require_once "include/functions.php";
session_start();
deleteUser($_GET["Id"]);
header("location:backOffice.php");
