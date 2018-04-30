<?php
require_once "include/functions.php";
session_start();
editGuide($_GET["mail"], $_GET["pseudo"], $_GET["age"], $_GET["gender"]);
header("location: backOfficeGuides");  
