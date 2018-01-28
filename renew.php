<?php
include('validation.php');
$session = new Session();
privatePage();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $session->renew();
}
