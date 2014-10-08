<?php
	define("ONE_YEAR", 3600*24*365);

	//Set a cookie in client to specify that this client is authenticated
	function setAuthCookie($username, $password) {
		if (validUser($username,$password)) {
			setcookie(getToken($username, $password), time()+ONE_YEAR);
			setcookie($username, time()+ONE_YEAR);	
		}
	}

	//Remove the cookie
	function removeAuthCookie($username, $password) {
		setcookie(getToken($username, $password), time()-ONE_YEAR)
		setcookie($username, time()-ONE_YEAR)
	}

	//Get the generated token, which will be in the cookie
	function getToken($username, $password){
		return $username.':'.md5($username.md5($password))
	}

	//Check if an user is already authenticated in the system
	function isAuthenticated($token, $username) {
		$user = getUser($username);
		return (isset($user) and getToken($username,$user["password"])==$token);
	}

	//Check if an user exist in the system
	function validUser($username, $password){
		//Comprueba si existe el usuario con esa contraseña
		$result = False;
		$user = getUser($userName);
		if(isset($user) && $user["password"]==md5($password)){
			$result = True;
		}

		return $result;
	}
?>