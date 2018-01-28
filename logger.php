<?php
include_once("validation.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = (isset($_POST['login_username'])) ? $_POST['login_username'] : '';
  $password = (isset($_POST['login_password'])) ? $_POST['login_password'] : '';
  if (checkDb($username, $password) == true) {
      header("Location: manage.php");
	  die();
  } else {
      logOut();
  }
}

