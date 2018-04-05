<?php
require_once "include/functions.php";
session_start();
banUser($_GET["Id"]);
header("location: backOffice.php");
