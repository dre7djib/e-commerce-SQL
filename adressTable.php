<?php

function getUserId($conn){
    // Get User Id 
    $query = "SELECT MAX(userId) FROM user";
    $result = $conn->query($query);
    
    if ($result) {
        $row = $result->fetch_row(); // Récupère la première colonne du résultat
        $maxUserId = $row[0]; // Stocke la valeur maximale dans une variable
        $result->close(); // Ferme le résultat
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }

    echo gettype($maxUserId);
    return $maxUserId;
}

function adressGen($faker,$conn,$userId){

    // Create Data
    $streetAddress  = $faker->streetAddress;
    $city = $faker->city;
    $state = $faker->state;
    $postcode = $faker->postcode; 

    // Insert Data
    $insert_query = "INSERT INTO address (street, city, state,  postal_code, userId) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ssssi", $streetAddress, $city, $state, $postcode,$userId);

    if ($stmt->execute()) {
        echo "Data inserted successfully.\n";
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

?>