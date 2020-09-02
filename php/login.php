<?php

session_start();

require 'common.php';

$un = htmlentities($_POST["inputEmail"]);
$pw = htmlentities($_POST["inputPass"]);

if (strlen($un) == 0){$errors = logError($errors, 404, "Email Field Not Recieved", "0");}
if (strlen($pw) == 0){$errors = logError($errors, 404, "Password Field Not Recieved", "0.1");}

$conn = conn("localhost","a1","alex","alex");

$loginQ = $conn -> prepare("SELECT * FROM USERS WHERE Username=:username AND Password=:password");

$loginQ -> bindParam(":username", $un);
$loginQ -> bindParam(":password", $pw);
$loginQ -> execute();

$user = $loginQ -> fetch();

if(!$user) //If not results Returned
{
    $errors = logError($errors, 401,"Email / Password not reconised", "1");
    relayError($errors);
}
else //If match found
{	
	$_SESSION["userID" ] = $user["userID"];
	//$_SESSION["isadmin"] = $user["Admin" ];
	//header("Location: ");
}

?>


   