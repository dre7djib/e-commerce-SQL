<?php

function getCartId($conn){
    // Get Product Names
    $query = "SELECT cartId FROM cart";
    $result = $conn->query($query);
    
    if ($result) {
        $cart = array(); // Crée un tableau pour stocker les noms des produits

        while ($row = $result->fetch_assoc()) {
            $cart[] = $row['cartId']; // Ajoute le nom du produit au tableau
        }

        // Imprime les noms des produits
        print_r($cart);

        $result->close(); // Ferme le résultat
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }
    return $cart;
}




?>