<?php
// start the session mechanism
session_start();

// destroy the entire session
session_destroy();

// redirect to home page
header('Location: index.php');
exit;
