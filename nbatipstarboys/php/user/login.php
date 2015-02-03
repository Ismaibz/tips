<?php

	require_once ("../config/db.php");
	require_once ("../db_connection/user.php");

	if (isset($_SERVER['REQUEST_METHOD'])){
		$method = $_SERVER['REQUEST_METHOD'];
		switch ($method) {
			case 'POST':			    
				if (isset($_POST["email"]) && $_POST["email"] != ""){ 
					$email = $_POST["email"]; 
					$password = $_POST["password"]; 
					$succeed = _login($email,$password); 
					echo json_encode($succeed);
				}
				break;		
			default:
				echo "error";
				break;
		}
	}
?>