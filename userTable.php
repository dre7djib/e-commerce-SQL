<?php

function userGen ($faker, $conn) {

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