<?php
require_once "../include/functions.php";
session_start();
banGuide($_GET["mail"]);
header("location: backOfficeGuides.php");
