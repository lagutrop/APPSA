<?php
/**
 * Created by Tiago.
 * Date: 27-01-2018
 * Time: 20:37
 */
include_once("../validation.php");
include_once("insert.php");
privatePage();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = json_decode(file_get_contents("php://input"));
    $message = insert($response);
    if ($message != "insert") {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(['data' => htmlspecialchars($message)]);
    }
}
