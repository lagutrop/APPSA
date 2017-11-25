<?php
header("Content-Type: text/json");
include '../lib//AltoRouter.php';
$router = new AltoRouter();  
$router->setBasePath('/appsa/app');

$router->map('GET', '/socio', function() {  
	exec("python ../cgi-bin/requestHandler.py", $output);
	$json = $output[0];
	$json_string = json_decode($json, true);
	$json_stringify = json_encode($json_string, JSON_PRETTY_PRINT);
	echo $json_stringify;
},'socios');

$router->map('GET', '/socio/[*:id]', function($id) {
	exec("python ../cgi-bin/requestHandler.py $id", $output);
	$json = $output[0];
	$json_string = json_decode($json, true);
	$json_stringify = json_encode($json_string, JSON_PRETTY_PRINT);
	echo $json_stringify;
},'socio');

$match = $router->match();

if( $match && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
?>