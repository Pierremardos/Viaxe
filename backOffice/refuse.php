<?php
include '../include/config.php';
include '../include/functions.php';
require_once "../include/functions.php";
session_start();
$mail = $_GET["mail"];
refuse($mail);
header("location: validDiplome.php");
exit;
