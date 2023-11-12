<?php


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