<?php
require_once "include/functions.php";
session_start();
unbanUser($_GET["mail"]);
header("location: backOffice.php");
