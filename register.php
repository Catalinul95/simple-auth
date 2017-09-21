<?php
require_once __DIR__ . '/init.php';

// make sure user can't access this page if he is logged in
if (isset($_SESSION['user'])) {
  header('Location: index.php');
  exit;
}


// if the form was submitted, then a POST request was sent to this file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  //FORM VALIDATION: if one of the fields is empty ( no data was submitted )
  // TODO: make it cleaner
  if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password_confirmation'])) {
    // store form validation errors in a session
    $_SESSION['errors'][] = 'Please fill all the fields.';
    header('Location: register.php');
    exit;
  }

  // store submited data in variables
  // using trim() we make sure to remove whitespaces
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $passwordConfirm = $_POST['password_confirmation'];

  //FORM VALIDATION: check length
  if (strlen($username) < 6 || strlen($username) > 64) {
    $_SESSION['errors'][] = 'The username must be between 6 and 64 characters.';
    header('Location: register.php');
    exit;
  }

  if (strlen($password) < 6 || strlen($password) > 64) {
    $_SESSION['errors'][] = 'The password must be between 6 and 64 characters.';
    header('Location: register.php');
    exit;
  }

  //FORM VALIDATION: check if username contains only letters
  if (!ctype_alpha($username)) {
    $_SESSION['errors'][] = 'The username must contain only letters.';
    header('Location: register.php');
    exit;
  }

  //FORM VALIDATION: make sure password matches
  if ($password !== $passwordConfirm) {
    $_SESSION['errors'][] = 'The password does not match.';
    header('Location: register.php');
    exit;
  }

  //FORM Validation: make sure the email is valid
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['errors'][] = 'Please enter a valid email address.';
    header('Location: register.php');
    exit;
  }

  // remove malicious characters from the data we want to save in database
  $username = mysqli_real_escape_string($db, $username);
  $email = mysqli_real_escape_string($db, $email);
  $password = mysqli_real_escape_string($db, $password);

  // let's hash the password for storing it in database
  $password = password_hash($password, PASSWORD_DEFAULT);

  // we have to check if the username or the email are already taken
  $sql = "SELECT id FROM users WHERE username = '{$username}' OR email = '{$email}'";
  $query = mysqli_query($db, $sql) or die(mysqli_error($db));

  // how many records are found
  if (mysqli_num_rows($query) > 0) {
    $_SESSION['errors'][] = 'The username or the email are already taken.';
    header('Location: register.php');
    exit;
  }

  // save a new user in databas
  $createdAt = date('Y-m-d H:i:s');
  $sql = "INSERT INTO users (username, email, password, created_at) VALUES ('{$username}', '{$email}', '{$password}', '{$createdAt}')";
  $query = mysqli_query($db, $sql) or die(mysqli_error($db));

  // redirect back
  $_SESSION['messages'][] = 'Your account has been created with success.';
  header('Location: register.php');
  exit;
}

// include the HTML content, called view
require __DIR__ . '/views/register.php';

// remove the form validation errors from the current session
if (isset($_SESSION['errors'])) {
  unset($_SESSION['errors']);
}

// remove the messages from the current session
if (isset($_SESSION['messages'])) {
  unset($_SESSION['messages']);
}
