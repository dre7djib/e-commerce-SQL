<?php

function getProductId($conn){
    // Get Product Names
    $query = "SELECT productId FROM product";
    $result = $conn->query($query);
    
    if ($result) {
        $products = array(); // Crée un tableau pour stocker les noms des produits

        while ($row = $result->fetch_assoc()) {
            $products[] = $row['productId']; // Ajoute le nom du produit au tableau
        }

        // Print les noms des produits
        print_r($products);

        $result->close(); // Ferme le résultat
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
    return $products;
}

function getProductPrice($conn){
    // Get Product Names
    $query = "SELECT price FROM product";
    $result = $conn->query($query);
    
    if ($result) {
        $products = array(); // Crée un tableau pour stocker les noms des produits

        while ($row = $result->fetch_assoc()) {
            $products[] = $row['price']; // Ajoute les noms des produits au tableau
        }

        // Print les noms des produits
        print_r($products);

        $result->close(); // Ferme le résultat
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
    return $products;
}



?>