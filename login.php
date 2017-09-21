<?php
// include the initialisation file
require_once __DIR__  .'/init.php';

// if the form was submitted, then a POST request was sent to this file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  echo 'Submitted';
}

// include the view file used for this page
require_once __DIR__ . '/views/login.php';
