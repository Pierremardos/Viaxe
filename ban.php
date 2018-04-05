<?php
require_once "include/functions.php";
session_start();
banUser($_GET["mail"]);
header("location: backOffice.php");
