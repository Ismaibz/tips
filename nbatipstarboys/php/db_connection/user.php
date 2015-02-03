<?php

require_once ("../config/db.php");

function _login($email,$password){

	_db_connect();
	
	$passEncriptada = sha1($password);

	$query = "Select Login('{$email}','{$passEncriptada}')";
	$resultado = _db_query($query);
	$campo = _db_fetch_array($resultado);
	$existe = current($campo);	
	if ($existe != 0){
		
		$sToken = md5(uniqid(mt_rand(), true));		
		$query = "Call InsertToken('{$email}','{$sToken}')";
		$resultado=_db_query($query);	

		$query = "Select UserType('{$existe}')";
		$resultado = _db_query($query);
		$campo = _db_fetch_array($resultado);
		$usertype = current($campo);		
		
 
		_db_close();
		$arr = array('Token' => $sToken, 'id' => $existe, 'type'=> $usertype);
		return $arr;	
	}
	else{
	       _db_close();
		   $arr = array('Token' => 0, 'id' => 0);
	       return $arr;
	}
	

}

function _register($email,$pass){
	_db_connect();
	
	$query = "Select UserExists('{$email}')";
	
	$resultado = _db_query($query);
	$campo = _db_fetch_array($resultado);
	$existe = current($campo);	

	if ($existe == 0){
	
		$passEncriptada = sha1($pass);
		$sToken = md5(uniqid(mt_rand(), true));
		$query = "Call Register('{$email}','{$passEncriptada}','{$sToken}')" ;
		_db_query($query);	
	
		$query = "Select GetUserId('{$email}')";
		$resultado = _db_query($query);
		$campo = _db_fetch_array($resultado);
		$id = current($campo);
				
		_db_close();
		$arr = array('Token' => $sToken, 'id' => $id);
		return $arr;	
	}	
	else {
		_db_close();
		$arr = array('Token' => 0, 'id' => 0, 'Error' => true);
		return $arr;	
	}
}

?>
