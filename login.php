<?php
// include the initialisation file
require_once __DIR__  .'/init.php';

// make sure user can't access this page if he is logged in
if (isset($_SESSION['user'])) {
  header('Location: index.php');
  exit;
}

// if the form was submitted, then a POST request was sent to this file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  //FORM VALIDATION - check if one of the fields is empty
  if (empty($_POST['email']) || empty($_POST['password'])) {
    $_SESSION['errors'][] = 'Plese fill all the required fields.';
    header('Location: login.php');
    exit;
  }

  // store form data in variables
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  // check if the credentials are correct
  $sql = "SELECT id, username, password FROM users WHERE email = '{$email}'";
  $query = mysqli_query($db, $sql) or die(mysqli_error($db));

  // store the query result
  $user = mysqli_fetch_assoc($query);

  // if there was no data found or the password is invalid
  if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['errors'][] = 'Invalid email or password.';
    header('Location: login.php');
    exit;
  }

  // store in a session all the user data and redirect to home page
  $_SESSION['user'] = $user;
  header('Location: index.php');
  exit;
}

// include the view file used for this page
require_once __DIR__ . '/views/login.php';

// remove the form validation errors from the current session
if (isset($_SESSION['errors'])) {
  unset($_SESSION['errors']);
}
