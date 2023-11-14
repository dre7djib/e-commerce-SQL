<?php

function getUserId($conn){ // Get User Id from the table user
    
    $query = "SELECT MAX(userId) FROM user";
    $result = $conn->query($query);
    
    if ($result) {
        $row = $result->fetch_row();
        $maxUserId = $row[0]; 
        $result->close(); 
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    }

    return $maxUserId;
}

function getRandomUserId($conn){ // Get a Random user Id from the table user
    $maxUser = intval(getUserId($conn));
    $randUserId = rand(1,$maxUser);
    return $randUserId;
}

function userGen ($faker, $conn) { // Generate the Data for the table user

    // Create Data
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;
    $email = $faker->email;
    $password_user = password_hash($faker->password, PASSWORD_DEFAULT); // Hash the password
    $phoneNumber = $faker->phoneNumber;


    // Insert Data
    $insert_query = "INSERT INTO user (firstName, lastName, email, password, phoneNumber) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $password_user, $phoneNumber);

    if ($stmt->execute()) {
        echo "Data inserted successfully.\n";
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

?>