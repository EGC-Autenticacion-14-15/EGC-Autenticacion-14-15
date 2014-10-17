<?php
include_once "variables.php";

function connect() {
	$con =null;
	try {
	$con = new PDO(DB_HOST,DB_USER,DB_PASS);
	} catch (PDOException $e) {echo $e->GetMessage();}
	return $con;
}

function setUp() {
	$con = connect();
	$stmt = $con->query('
		DROP TABLE IF EXISTS USERS;
		CREATE TABLE USERS (
		U_ID INT AUTO_INCREMENT,
		USERNAME VARCHAR(40) UNIQUE,
		PASSWORD VARCHAR(40),
		EMAIL VARCHAR(100) UNIQUE,
		PRIMARY KEY(U_ID)
		);
		');
}

function getUser($user) {
	$con = connect();
	$stmt = $con->prepare("SELECT USERNAME, PASSWORD, EMAIL FROM USERS WHERE NICK=:user");
	$stmt->bindParam(':user',$user);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetch();
}

function getAllUsers() {
	$con = connect();
	$stmt = $con->prepare("SELECT USERNAME, PASSWORD, EMAIL FROM USERS");
	$stmt->execute();
	return $stmt->fetch();
}

function createUser($username, $password, $email) {
	$con = connect();
	$stmt = $con->prepare("INSERT INTO USERS VALUES(null, :username, :password, :email");
	$stmt->bindParam(':username',$username);
	$stmt->bindParam(':password',$password);
	$stmt->bindParam(':email',$email);
	$stmt->execute();
}

?>