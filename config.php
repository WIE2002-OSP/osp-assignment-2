<?php
/* Database credentials.*/
## Required to be change then
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'gaychin');
define('DB_PASSWORD', 'admin');
define('DB_NAME', 'do_quiz');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}