<?php
	
	define("ONE_YEAR", 3600*24*365);

	function setAuthCookie($username, $password) {
		if (validUser($username,$password)) {
			setcookie(getToken($username, $password), time()+ONE_YEAR);
			setcookie($username, time()+ONE_YEAR);	
		}
	}

	function removeAuthCookie($username, $password) {
		setcookie(getToken($username, $password), time()-ONE_YEAR)
		setcookie($username, time()-ONE_YEAR)
	}

	function isAuthenticated($token, $username) {
		$user = getUser($username);
		return (isset($user) and getToken($username,$user["password"])==$token);
	}

	function getToken($username, $password){
		return $username.':'.md5($username.md5($password))
	}

	function validUser($username, $password){
		//Comprueba si existe el usuario con esa contraseña
		$result = False;
		$user = getUser($userName);
		if(isset($user) && $user["password"]==md5($password)){
			$result = True;
		}

		return $result;
	}


	fuction has_voted($user, $voting_id){
		$voted = false;
		$db_user = getUser($user);
		if(isset($db_user)){
			$voted = in_aray($voting_id, $db_user["voting"]);
		}

	return $voted;
	}

	function mark_as_voted($user, $voting_id){
		$votings = $user["votings"]
		if(has_voted($user, $voting_id) && !in_array($voting_id, $votings)){
			$votings[] = $voting_id
		}
	}


?>