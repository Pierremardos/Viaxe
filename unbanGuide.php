<?php
require_once "include/functions.php";
session_start();
unbanGuide($_GET["mail"]);
header("location: backOfficeBannedGuides"); 
