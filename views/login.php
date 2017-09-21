<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login Page | Simple authentication system made with PHP.</title>
  </head>
  <body>
      <h1>Register Page</h1>
      <hr>
      <?php if (isset($_SESSION['errors'])): ?>
        <p><b>Whoops!</b> <?=$_SESSION['errors'][0];?></p>
      <?php endif; ?>
      <form action="login.php" method="post">
        <p>
          Email: <input type="email" name="email" required>
        </p>
        <p>
          Password: <input type="password" name="password" required>
        </p>
        <button type="submit">Login</button>
      </form>
  </body>
</html>
