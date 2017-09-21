<?php
// make sure all errors are displayed
error_reporting(E_ALL);
ini_set('display_errors', 1);

// start the session mechanism
// it gives us the power to persist data on other pages
session_start();

// TODO: move it to its own file
// connect to database
$db = mysqli_connect("127.0.0.1", "root", "", "simple_auth");

// check connection status
if (mysqli_connect_errno()) {
  echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
}
