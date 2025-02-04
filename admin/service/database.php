<?php
$host = "localhost";
$user = "root"; // atau username MySQL Anda
$password = ""; // atau password MySQL Anda
$database = "database_santri";

$db = mysqli_connect($host, $user, $password, $database);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
