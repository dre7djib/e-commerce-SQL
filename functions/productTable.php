<?php

function getProductId($conn){
    // Get Product Names
    $query = "SELECT productId FROM product";
    $result = $conn->query($query);
    
    if ($result) {

        while ($row = $result->fetch_assoc()) {
            $products = $row['productId'];
        }

        $result->close(); 
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
    return $products;
}


function getMaxProductId($conn){ // Get User Id 
    $query = "SELECT MAX(productId) FROM product";
    $result = $conn->query($query);
    
    if ($result) {
        $row = $result->fetch_row();
        $maxProductId = $row[0];
        $result->close();
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
    return $maxProductId;
}

function getProductPrice($conn,$productId){  // Get Product Names
    $query = "SELECT price FROM product WHERE productId = " . $productId;
    $result = $conn->query($query);
    
    if ($result) {
        $products = array();

        while ($row = $result->fetch_assoc()) {
            $products[] = $row['price'];
        }

        $result->close();
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
    return $products;
}

function getProductName($conn,$productId){ // Get Product Names
    $query = "SELECT name FROM product WHERE productId = " . $productId;
    $result = $conn->query($query);
    
    if ($result) {
        $products = array();

        while ($row = $result->fetch_assoc()) {
            $products = $row['name'];
        }

        $result->close();
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
    return $products;
}

function getRandomProductId($conn){ // Get User Id 
    $query = "SELECT MAX(productId) FROM product";
    $result = $conn->query($query);
    
    if ($result) {
        $row = $result->fetch_row();
        $maxProductId = $row[0];
        $result->close();
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
    $randomProductId = rand(1,intval($maxProductId));
    return $randomProductId;
}



?>