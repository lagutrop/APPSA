<?php
ini_set("session.use_strict_mode", 1);
session_start();

function connectDb() {
    $servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "appsa";
    // Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
    return $conn;
}

function deleteExpiredSessions() {
    $conn = connectDb();
    $sql = "DELETE FROM sessao WHERE data + 10 < unix_timestamp()";
    $result = $conn->query($sql);
}

function deleteSession($id) {
    $conn = connectDb();
    $sql = "DELETE FROM sessao WHERE id = '".$id."'";
    $result = $conn->query($sql);
}

function checkDb($user, $pw) {
	$user = addslashes($user);
  	$pass = addslashes($pw);
	$conn = connectDb();
	$sql = "SELECT senha FROM utilizador WHERE nome = '".$user."' LIMIT 1";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
			$dbpw = $row['senha'];
    	}
	} else {
    	return false;
	}
	$verifier = password_verify($pass, $dbpw);
    deleteExpiredSessions();
    $sql = "SELECT COUNT(nome) as total FROM sessao WHERE nome = '".$user."'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
	if ($verifier === true && $data['total'] <= 0) {
        $timeStamp = time();
        $_SESSION['authenticated'] = true;
        $_SESSION['timestamp'] = $timeStamp;
        session_regenerate_id(true); 
        $sql = "INSERT INTO sessao VALUES('".session_id()."', '".$user."', '".$timeStamp."')";
        $result = $conn->query($sql);
		$conn->close();
		return true;
	}
	$conn->close();
	return false;
}

/*function produceToken($username) {
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
}*/

function privatePage() {
 	if (!isset($_SESSION['authenticated']) || time() - $_SESSION['timestamp'] > 1800) {
    	logOut();
  	}
}

function renewSession() {
    $oldSessionId = session_id();
    $timeStamp = time();
    $conn = connectDb();
    $expired = isExpired() ? 'true' : 'false';
    if (!isExpired()) {
        session_regenerate_id(true);
        $newSessionId = session_id();
        $sql = "UPDATE sessao SET id = '".$newSessionId."' WHERE id = '".$oldSessionId."'";
        $result = $conn->query($sql);
        $_SESSION['timestamp'] = $timeStamp;	
	} else {
        logOut();
    }
}

function isExpired() {
    deleteExpiredSessions();
    $conn = connectDb();
    $sessionId = session_id();
    $sql = "SELECT id FROM sessao WHERE id = '".$sessionId."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return false;
    }
    return true;
}

function redirectLoggedUsers() {
	if (isset($_SESSION['authenticated'])) {
		header("Location: member.php");
		exit();
	}
}

function logOut() {
  	unset($_SESSION['authenticated']);
    unset($_SESSION['timestamp']);
    deleteSession(session_id());
	session_destroy();
  	header("Location: index.php");
	exit();
}
?>