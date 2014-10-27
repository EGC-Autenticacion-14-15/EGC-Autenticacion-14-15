<?php
	// Check if an user has voted in a specific voting
	function hasVoted($user, $voting_id){
		$voted = false;
		$db_user = getUser($user);
		if(isset($db_user)){
			$voted = in_aray($voting_id, $db_user["voting"]);
		}

	return $voted;
	}

	// Mark an user as voted in a specific voting
	function markAsVoted($user, $voting_id){
		$votings = $user["votings"];
		if(has_voted($user, $voting_id) && !in_array($voting_id, $votings)){
			$votings[] = $voting_id;
		}
	}
?>