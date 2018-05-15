<?php
require_once "include/functions.php";
session_start();
answerMessageClient($_POST["comment"], $_SESSION["mail"]);
header("location: messageClient.php");
