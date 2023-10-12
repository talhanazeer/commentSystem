<?php
define('HOST_ADDRESS', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'comments_system');
//Open a new connection to the MySQL server
$mysqli = new mysqli(HOST_ADDRESS, DB_USER, DB_PASSWORD, DB_NAME);

//Output any connection error
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}else{
    date_default_timezone_set('Asia/Karachi');

}