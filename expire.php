<?php
include('validation.php');
$session = new Session();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if ($session->isExpired()) {
        echo json_encode(["data" => "expired"]);
    } else {
        echo json_encode(["data" => "logged"]);
    }
}
