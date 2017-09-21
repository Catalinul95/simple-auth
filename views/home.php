<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Simple authentication system made with PHP.</title>
  </head>
  <body>
      <h1>Simple authentication system</h1>
      <hr>
      <?php if (isset($_SESSION['user'])): ?>
        <h3>Welcome back, <?=$_SESSION['user']['username'];?>!</h3>
        <a href="logout.php">Logout</a>
      <?php else: ?>
      <ul>
        <li>
          <a href="login.php">Login page</a>
        </li>
        <li>
          <a href="register.php">Register Page</a>
        </li>
      </ul>
      <?php endif; ?>

      <p>
        <small>This is a simple authentication system made with PHP, having MySQL as the database.It uses the procedural style.</small>
      </p>
  </body>
</html>
