<?php
/*Archivo dedicado a intentar realizar login. Si hay error, se redirige al usuario*/

session_start()

include_once "auth.php";

$user="";
$pass="";
if(isset($_REQUEST["user"])){
	$user = htmlspecialchars($_REQUEST["user"]);
	$pass = htmlspecialchars($_REQUEST["pass"]);
}

//Comprueba que se haya introducido nombre y contraseña con longitud apropiada o si no se han pasado como parámetros
if(strlen($user)<5) {
	error("shortUser");
}

if(strlen($pass)<5) {
	error("shortPass");
}

try{
	//Comprueba que hay un usuario con ese nombre y contraseña
	$loginRes = validUser($user, $pass);
	if($loginRes) {
		setAuthCookie($user, $pass);
		header('Location; ./?cont=home')
	}else{
		error("wrongPass");
	}
}catch(PDOException $e){
	error("connectionFailed");
}

function error($name){
	header('Location: ./?cont=login&error='.$name.'$logout=1');
	die("Está siendo redirigido...");
}
?>