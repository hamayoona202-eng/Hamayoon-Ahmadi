<?php
/**
 * Name: Hamayoon
 * ID: R01014419
 */

$servername = "localhost";
$username   = "root";
$password   = "Hamayoon123$5";               // Change if your MySQL root has a password
$dbname     = "admission_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>