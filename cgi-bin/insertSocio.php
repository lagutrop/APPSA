<?php
include("validation.php");
privatePage();
$data = json_decode(file_get_contents("php://input"))
?>