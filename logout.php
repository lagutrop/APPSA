<?php
include('validation.php');
privatePage();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	logOut();
}
?>