<?php
// Include the Composer autoloader
require 'vendor/autoload.php';
require __DIR__ . '/userTable.php';
require __DIR__ . '/adressTable.php';
include_once 'productTable.php';
require __DIR__ . '/cartTable.php';

// Import the Faker namespace
use Faker\Factory;

// Create a Faker instance
$faker = Factory::create();

$servername = "localhost:8889";
$username = "root";
$password = "root";
$database = "e-commerce";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//userGen($faker, $conn);
//adressGen($faker,$conn,getUserId($conn));
getProductName($conn,11);
cartGen($faker,$conn,getRandomUserId($conn));


// Close the database connection when done
$conn->close();
?>
