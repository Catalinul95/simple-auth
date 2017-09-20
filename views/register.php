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
      <?php if (isset($_SESSION['messages'])): ?>
        <p><b>Success!</b> <?=$_SESSION['messages'][0];?></p>
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
