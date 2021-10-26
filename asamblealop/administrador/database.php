<?php
$server = '172.17.0.78';
$username = 'wordpressuser';
$password = '#S3rv2019$';
$database = 'db-pasarela-somosuno-test';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>
