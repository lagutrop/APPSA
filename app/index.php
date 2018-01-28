<?php
header("Content-Type: text/json");
include '../lib/AltoRouter.php';
$router = new AltoRouter();
$router->setBasePath('/appsa/app');

try {
    $router->map('GET', '/socio', function () {
        exec("python ../cgi-bin/requestHandler.py", $output);
        $json_result = $output[0];
        $json_string = json_decode($json_result, true);
        $json_stringify = json_encode($json_string, JSON_PRETTY_PRINT);
        echo $json_stringify;
    }, 'socios');
} catch (Exception $exception) {
    echo "Internal Error";
}

try {
    $router->map('GET', '/socio/[*:id]', function ($id) {
        $escaped_id = escapeshellarg($id);
        $escaped_command = escapeshellcmd("python ../cgi-bin/requestHandler.py $escaped_id");
        exec($escaped_command, $output);
        $json_result = $output[0];
        $json_string = json_decode($json_result, true);
        $json_stringify = json_encode($json_string, JSON_PRETTY_PRINT);
        echo $json_stringify;
    }, 'socio');
} catch (Exception $exception) {
    echo "Internal Error";
}

$match = $router->match();

if( $match && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
