<?php

include_once 'productTable.php';

function getCartId($conn){  // Get the cart id from the table cart
    $query = "SELECT cartId FROM cart";
    $result = $conn->query($query);
    
    if ($result) {
        $cart = array(); 

        while ($row = $result->fetch_assoc()) {
            $cart[] = $row['cartId'];
        }

        print_r($cart);

        $result->close();
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
    return $cart;
}

function cartGen($faker, $conn, $userId) { // Generate Data for the cart
    $order = rand(1, 1);
    
    // Insert Data
    $insert_query = "INSERT INTO cart (userId, productId, quantity) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);

    if (!$stmt) {
        echo "Erreur de préparation de la requête : " . $conn->error;
        return;
    }

    for ($i = 1; $i <= $order; $i++) {
        $quantity = rand(1, 3);

        for ($j = 1; $j <= $quantity; $j++) {
            $maxProductId = intval(getMaxProductId($conn));
            $productId = rand(0, $maxProductId);
            $name = getProductName($conn, $productId);

            if (!$stmt) {
                echo "Erreur de préparation de la requête : " . $conn->error;
                return;
            }

            $userId = intval($userId);

            $stmt->bind_param("iii", $userId, $productId, $quantity);
            $stmt->execute();

            echo $userId . " " . $productId . " " . $quantity . " " . $name . " ";
        }
    }

    $stmt->close();
}

?>