<?php
include('validation.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isExpired()) {
        echo json_encode(array("data"=>"expired"));    
    } else {
        echo json_encode(array("data"=>"logged"));
    }
}
?>