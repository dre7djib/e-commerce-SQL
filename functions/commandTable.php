<?php

function commandGen($faker,$conn, $userId,$addressId,$productId) { // Generate Data for the table command

    // Generate random dates for delivery and purchase
    $orderDate = $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d');
    $deliveryDate = $faker->dateTimeBetween($orderDate, '+1 month')->format('Y-m-d');

    // Select a random product and quantity
    $quantity = rand(1, 5);

    // Insert the order into the command table
    $insertQuery = "INSERT INTO command (userId, productId, quantity, orderDate, delivery, addressId) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);

    if (!$stmt) {
        echo "Erreur de préparation de la requête : " . $conn->error;
        return;
    }

    $stmt->bind_param("iiissi", $userId, $productId, $quantity, $orderDate, $deliveryDate, $addressId);

    if ($stmt->execute()) {
        echo "Order inserted successfully.\n";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
    $stmt->close();
}


?>