<?php

// Set the token/user cookies for the client
function setAuthCookie($username, $password) {
	if (validUser($username,$password)) {
		setcookie(getToken($username, $password), time()+ONE_YEAR);
		setcookie($username, time()+ONE_YEAR);	
	}
}

// Removes the token/user cookies for the client
function removeAuthCookie($username, $password) {
	setcookie(getToken($username, $password), time()-ONE_YEAR)
	setcookie($username, time()-ONE_YEAR)
}

// Returns true if a client is authenticated
function isAuthenticated($token, $username) {
	$user = getUser($username);
	return (isset($user) and getToken($username,$user["password"])==$token);
}

// Generates the token
function generateToken($username, $password){
	return $username.':'.md5($username.md5($password))
}

// Returns whether a user is valid
function validUser($username, $password){
	$result = False;
	$user = getUser($username);
	if(isset($user) && $user["password"]==md5($password)){
		$result = True;
	}

	return $result;
}

// Returns whether an user has voted on a voting
function hasVoted($user, $voting_id){
	$voted = false;
	$db_user = getUser($user);
	if(isset($db_user)){
		$voted = in_aray($voting_id, $db_user["voting"]);
	}

	return $voted;
}

// Mark an user as voted
function markAsVoted($user, $voting_id){
	$votings = $user["votings"]
	if(has_voted($user, $voting_id) && !in_array($voting_id, $votings)){
		$votings[] = $voting_id
	}
}


?>