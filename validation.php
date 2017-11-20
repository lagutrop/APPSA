<?php
ini_set("session.use_strict_mode", 1);
session_start();
session_regenerate_id(true);
function checkDb($user, $pw) {
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "appsa";
	$table = "utilizador";
	$user = addslashes($user);
  	$pass = addslashes($pw);
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT senha FROM ".$table." WHERE nome = '".$user."' LIMIT 1";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
			$dbpw = $row['senha'];
    	}
	} else {
    	return false;
	}
	$verifier = password_verify($pass, $dbpw);
	if ($verifier === true) {
		$_SESSION['authenticated'] = true;
		$conn->close();
		return true;
	}
	$conn->close();
	return false;
}

function produceToken($username) {
	$key = "private_key";
	$header = ['typ' => 'JWT', 'alg' => 'HS256'];
	$header = json_encode($header);
	$header = base64_encode($header);
	$payload = ['jti' => base64_encode(mcrypt_create_iv(32)), 'iss' => 'www.appsa.pt', 'user' => ["name" => $username, 'role' => 'admin'], "iat" => time(), 'exp' => time() + 60];
	$payload = json_encode($payload);
	$payload = base64_encode($payoad);
	$signature = hash_hmac('sha256', "{$header}.{$payload}", $key, true);
	$signature = base64_encode($signature);
	$token = "{$header}.{$payload}.{$signature}";
	return $token;
}

function compareToken($token) {
	
}

function privatePage() {
 	if (!isset($_SESSION['authenticated'])) {
    	logOut();
  	}
}

function redirectLoggedUsers() {
	if (isset($_SESSION['authenticated'])) {
		header("Location: member.php");
		exit();
	}
}

function logOut() {
  	unset($_SESSION['authenticated']);
	session_destroy();
  	header("Location: index.php");
	exit();
}
?>