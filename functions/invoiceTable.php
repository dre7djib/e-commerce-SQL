<?php

function invoiceGen($conn) {
    // Select a random command from the command table
    $commandId = getRandomCommandId($conn);

    // get the details of the selected command
    $commandDetails = getCommandDetails($conn, $commandId);

    if (!$commandDetails) {
        echo "Failed to retrieve details for Command ID $commandId";
        return;
    }

    // Calculate the  price of all the products
    $totalPrice = calculateTotalPrice($conn, $commandId, $commandDetails['orderDate']);

    // Insert the data in the table invoice
    $insertQuery = "INSERT INTO invoices (total_amount, invoice_date, commandId) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    if (!$stmt) {
        echo "Erreur de préparation de la requête : " . $conn->error;
        return;
    }
    $stmt->bind_param("dsi", $totalPrice, $commandDetails['orderDate'], $commandId);
    if ($stmt->execute()) {
        echo "Order inserted successfully.\n";
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
    $stmt->close();

}

// Function to get a random command ID
function getRandomCommandId($conn) {
    $query = "SELECT commandId FROM command ORDER BY RAND() LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['commandId'];
    }

    return null;
}


function getCommandDetails($conn, $commandId) {  // Get the details of the selected command
    $query = "SELECT userId, orderDate, delivery FROM command WHERE commandId = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo "Erreur de préparation de la requête : " . $conn->error;
        return null;
    }

    $stmt->bind_param("i", $commandId);
    $stmt->execute();
    $stmt->bind_result($userId, $orderDate, $deliveryDate);
    $stmt->fetch();
    $stmt->close();

    return [
        'userId' => $userId,
        'orderDate' => $orderDate,
        'delivery' => $deliveryDate,
    ];
}

// Function to calculate the total price of products associated with a command
function calculateTotalPrice($conn, $commandId, $orderDate) {
    $query = "SELECT SUM(price * quantity) AS totalPrice FROM product p
              INNER JOIN command c ON p.productId = c.productId
              WHERE c.commandId = ? AND c.orderDate = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo "Erreur de préparation de la requête : " . $conn->error;
        return null;
    }

    $stmt->bind_param("is", $commandId, $orderDate);
    $stmt->execute();
    $stmt->bind_result($totalPrice);
    $stmt->fetch();
    $stmt->close();

    return $totalPrice;
}


?>