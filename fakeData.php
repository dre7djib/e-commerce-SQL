<?php

require 'vendor/autoload.php';
require __DIR__ . '/functions/userTable.php';
require __DIR__ . '/functions/adressTable.php'; 
require __DIR__ . '/functions/productTable.php';
require __DIR__ . '/functions/cartTable.php';
require __DIR__ . '/functions/commandTable.php';
require __DIR__ . '/functions/invoiceTable.php';

// Import Faker
use Faker\Factory;

$faker = Factory::create();

// Create the connection betwenn the script and the database
$servername = "localhost:8889";
$username = "root";
$password = "root";
$database = "e-commerce";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

userGen($faker, $conn); // Générateur pour la table user
adressGen($faker, $conn, getUserId($conn)); // Générateur pour la table address
cartGen($faker, $conn, getRandomUserId($conn)); // Générateur pour la table cart
commandGen($faker,$conn,getRandomUserId($conn),getAddressByUserId($conn, $userId),getRandomProductId($conn)); // Générateur pour la table command
invoiceGen($conn); // Générateur pour la table invoice

$conn->close();
?>
