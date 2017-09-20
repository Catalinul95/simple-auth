<?php
// make sure all errors are displayed
error_reporting(E_ALL);
ini_set('display_errors', 1);

// if the formular was submitted, then a POST request was sent to this file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  echo 'Submitted!';
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
