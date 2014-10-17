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
		NICK VARCHAR(40),
		PASSWORD VARCHAR(40),
		NAME VARCHAR(100),
		COUNTRY INT,
		PRIMARY KEY(U_ID)
		);
		INSERT INTO USERS VALUES (0,"username","password1234","Juan Carlos Roldán Salvador",1);

		DROP TABLE IF EXISTS ACCOUNTS;
		CREATE TABLE ACCOUNTS (
		A_ID INT AUTO_INCREMENT,
		TYPE VARCHAR(40),
		VALUE VARCHAR(100),
		U_ID INT REFERENCES USERS(U_ID),
		PRIMARY KEY(A_ID)
		);
		INSERT INTO ACCOUNTS VALUES (0,"Twitter","@JCx64",(SELECT U_ID FROM USERS WHERE NICK = "username"));

		DROP TABLE IF EXISTS TAGS;
		CREATE TABLE TAGS (
		T_ID INT AUTO_INCREMENT,
		VALUE VARCHAR(140),
		U_ID INT REFERENCES USERS(U_ID),
		PRIMARY KEY(T_ID)
		);
		INSERT INTO TAGS VALUES (0,"Owner of this website",(SELECT U_ID FROM USERS WHERE NICK = "JCx64"));
		
		DROP TABLE IF EXISTS PROJECTS;
		CREATE TABLE PROJECTS (
		P_ID INT AUTO_INCREMENT,
		NAME VARCHAR(40),
		DESCRIPTION VARCHAR(1400),
		PRIMARY KEY(P_ID)
		);
		
		DROP TABLE IF EXISTS MEMBERS;
		CREATE TABLE MEMBERS (
		P_ID INT REFERENCES PROJECTS(P_ID),
		U_ID INT REFERENCES USERS(U_ID),
		PRIMARY KEY(P_ID,U_ID)
		);

		');
}

function userId(user,pass) {
	$con = connect();
	$stmt = $connection->prepare("SELECT U_ID FROM USERS WHERE NICK=:user AND PASSWORD=:pass");
	$stmt->bindParam(':user',$user);
	$stmt->bindParam(':pass',$pass);
	$stmt->execute();
	return $stmt->fetch();
}

?>