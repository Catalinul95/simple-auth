<?php
// make sure all errors are displayed
error_reporting(E_ALL);
ini_set('display_errors', 1);

// start the session mechanism
// it gives as the power to persist data on other pages
session_start();

// if the form was submitted, then a POST request was sent to this file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // if one of the fields is empty ( no data was submitted )
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
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Register Page | Simple authentication system made with PHP.</title>
  </head>
  <body>
      <h1>Register Page</h1>
      <hr>
      <?php if (isset($_SESSION['errors'])): ?>
        <p><b>Whoops!</b> <?=$_SESSION['errors'][0];?></p>
      <?php endif; ?>
      <form action="register.php" method="post">
        <p>
          Username: <input type="text" name="username" required>
        </p>
        <p>
          Email: <input type="email" name="email" required>
        </p>
        <p>
          Password: <input type="password" name="password" required>
        </p>
        <p>
          Confirm Password: <input type="password" name="password_confirmation" required>
        </p>
        <button type="submit">Register</button>
      </form>
  </body>
</html>
<?php
// remove the form validation errors from the current session
if (isset($_SESSION['errors'])) {
  unset($_SESSION['errors']);
}
?>
