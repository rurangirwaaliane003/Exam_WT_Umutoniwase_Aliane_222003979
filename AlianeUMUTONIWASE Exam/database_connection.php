<?php
// Connection details
$host = "localhost";
$user = "aliane";
$pass = "aliane123";
$database = "professional_networking_events";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
