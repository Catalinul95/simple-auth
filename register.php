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
