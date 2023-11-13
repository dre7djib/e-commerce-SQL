<?php

require 'vendor/autoload.php';
require __DIR__ . '/userTable.php';
require __DIR__ . '/adressTable.php'; 
require __DIR__ . '/productTable.php';
require __DIR__ . '/cartTable.php';
require __DIR__ . '/commandTable.php';

// Import Faker
use Faker\Factory;

$faker = Factory::create();

$servername = "localhost:8889";
$username = "root";
$password = "root";
$database = "e-commerce";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// userGen($faker, $conn); // Générateur pour la table user
// addressGen($faker, $conn, getUserId($conn)); // Générateur pour la table address
//cartGen($faker, $conn, getRandomUserId($conn)); // Générateur pour la table cart
//commandGen($faker,$conn,getRandomUserId($conn),getAddressByUserId($conn, $userId),getRandomProductId($conn)); // Générateur pour la table command


$conn->close();
?>
