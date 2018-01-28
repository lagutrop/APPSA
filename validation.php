<?php
include_once("Database.php");
include_once("Session.php");
ini_set("session.use_strict_mode", 1);
session_start();

/**
 * User Login Validation
 * @param $user
 * @param $pw
 * @return bool
 */
function checkDb($user, $pw) {
    $database = new Database();
    $session = new Session();
    if (!validateInput($user)) {
        return false;
    }
    $user = $database->escape($user);
    $result = $database->select('senha', 'utilizador', 'nome = ? LIMIT 1', 's', [$user]);
	if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
			$dbpw = $row['senha'];
    	}
	} else {
    	return false;
	}
    if (!empty($dbpw)) {
        $verifier = password_verify($pw, $dbpw);
    } else {
        return false;
    }
    $session->delete();
    $result = $database->select(
        'COUNT(nome) as total',
        'sessao',
        'nome = ?',
        's', [$user]
    );
    $data = $result->fetch_assoc();
	if ($verifier === true && $data['total'] <= 0) {
        $session->insert($user);
        return true;
    } else {
        if ($verifier === true && $data['total'] > 0) {
            $session->update('nome', $user);
            return true;
        }
    }
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

/**
 * Page that requires authentication to be viewed
 */
function privatePage() {
    if (!isset($_SESSION['authenticated']) || time() - $_SESSION['timestamp'] > 3600) {
        logOut();
    }
}

/**
 * Redirect users to specific page
 */
function redirectLoggedUsers() {
	if (isset($_SESSION['authenticated'])) {
        header("Location: manage.php");
		exit();
	}
}

/**
 * Logout connected users
 */
function logOut() {
    $session = new Session();
    $session->delete($session->get());
    $session->destroy();
    header("Location: login.php");
	exit();
}

/**
 * Remove bad characters to avoid injection
 * @param $value
 * @return bool
 */
function validateInput($value)
{
    $value = filter_var($value, FILTER_SANITIZE_STRING);
    if (!isset($value)) {
        return false;
    }
    return true;
}