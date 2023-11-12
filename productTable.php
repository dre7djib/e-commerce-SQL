<?php

function getProductId($conn){
    // Get Product Names
    $query = "SELECT productId FROM product";
    $result = $conn->query($query);
    
    if ($result) {

        while ($row = $result->fetch_assoc()) {
            $products = $row['productId']; // Ajoute le nom du produit au tableau
        }

        $result->close(); // Ferme le résultat
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
    return $products;
}


function getMaxProductId($conn){
    // Get User Id 
    $query = "SELECT MAX(productId) FROM product";
    $result = $conn->query($query);
    
    if ($result) {
        $row = $result->fetch_row(); // Récupère la première colonne du résultat
        $maxProductId = $row[0]; // Stocke la valeur maximale dans une variable
        $result->close(); // Ferme le résultat
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
    return $maxProductId;
}

function getProductPrice($conn,$productId){
    // Get Product Names
    $query = "SELECT price FROM product WHERE productId = " . $productId;
    $result = $conn->query($query);
    
    if ($result) {
        $products = array(); // Crée un tableau pour stocker les noms des produits

        while ($row = $result->fetch_assoc()) {
            $products[] = $row['price']; // Ajoute les noms des produits au tableau
        }

        $result->close(); // Ferme le résultat
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
    return $products;
}

function getProductName($conn,$productId){
    // Get Product Names
    $query = "SELECT name FROM product WHERE productId = " . $productId;
    $result = $conn->query($query);
    
    if ($result) {
        $products = array(); // Crée un tableau pour stocker les noms des produits

        while ($row = $result->fetch_assoc()) {
            $products = $row['name']; // Ajoute les noms des produits au tableau
        }

        $result->close(); // Ferme le résultat
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
    return $products;
}



?>