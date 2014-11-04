<?php
	include_once "database.php";


	// Set a cookie in client to specify that this client is authenticated
	function setAuthCookie($username, $password) {
		if (validUser($username,$password)) {
			setcookie("token",getToken($username, $password), time()+ONE_YEAR);
			setcookie("user",$username, time()+ONE_YEAR);	
		}
	}

	// Remove the cookie
	function removeAuthCookie($username, $password) {
		setcookie("token",getToken($username, $password), time()-ONE_YEAR);
		setcookie("user",$username, time()-ONE_YEAR);
	}

	// Get the generated token, which will be in the cookie
	function getToken($username, $password){
		return $username.':'.md5($username.md5($password));
	}

	// Check if an user is already authenticated in the system
	function isAuthenticated($token, $username) {
		$user = getUser($username);
		return (isset($user) and getToken($username,$user["2"])==$token);
	}

	// Check if an user is already authenticated in the system looking at cookies
	function isAuthenticated() {
		if (isset($_COOKIE["user"]) and isset($_COOKIE["token"])) {
			return isAuthenticated($_COOKIE["token"], $_COOKIE["user"]);
		} else {
			return false;
		}
	}

	// Check if an user exist in the system
	function validUser($username, $password){
		$result = False;
		$user = getUser($username);
		if(isset($user) && $user["password"]==md5($password)){
			$result = True;
		}

		return $result;
	}
	// Check if the user is authenticated, using the username in the token
	function tokenIsCorrect($token){
		$username = explode(':', $token)[0];
		return isAuthenticated($token, $username);
	}
?>