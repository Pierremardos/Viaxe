<?php
require_once "include/functions.php";
session_start();
editUser($_GET["mail"]);
header("location: backOffice.php");
