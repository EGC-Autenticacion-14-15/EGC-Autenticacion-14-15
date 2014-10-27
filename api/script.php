<?php
	include_once "../auth.php";

	if(!isset($_GET['method']) || $_GET['method'] == ""){
		badRequest();
	}else{
		switch ($_GET['method']) {
			case 'getUsers':
				getUsers();
				break;
			default:
				badRequest();
				break;
		}
	}

	function badRequest(){
		header('HTTP/1.1 400 Bad Request');

		echo "Bad Request. This method doesn't exists";
	}

	function getUsers(){
		header('HTTP/1.1 200 OK');

		$users = json_encode(getAllUsers());

		echo $users;
	}
?>