<?php
require_once "../include/functions.php";
session_start();
answerMessageBackOffice($_POST["comment"], $_POST["mailCustomer"]);
header("location: backOfficeMessages.php");
