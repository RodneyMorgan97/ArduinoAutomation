<?php

if(isset($_POST['temp'])) {
	$type = 2;
	$value = $_POST['temp'];
}

if(isset($_POST['args'])) {
	$type = 2;
	$value = $_POST['temp'];
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "arduino";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO Data (type, value, timestamp)
VALUES ($type, $value, NOW())";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>