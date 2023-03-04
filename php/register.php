<?php
require_once 'config.php';

	$user_name = $_POST['first_name'];
	$user_lastname = $_POST['last_name'];
	$user_password = $_POST['password'];	
	$user_email = $_POST['email'];
	$statement = $db->prepare("SELECT email FROM users WHERE email= :email");
	$statement->execute(array(':email' => $_POST['email']));
	
	$row = $statement->fetchAll(PDO::FETCH_ASSOC);
	if(!$row['email']){	

		$stmt = $db->prepare("INSERT INTO users(`first_name`, `last_name`, `email`, `password`) 
VALUES (:user_name, :user_lastname, :user_email,:user_password)");
		echo $user_password;
		$stmt->bindValue(':user_name', $user_name);
		$stmt->bindValue(':user_lastname', $user_lastname);
		$stmt->bindValue(':user_email', $user_email);
		$stmt->bindValue(':user_password', password_hash($user_password, PASSWORD_DEFAULT));
		$stmt->execute();		
		echo "registered";
	} else {				
		echo "User already registered";	 
	}
?>
