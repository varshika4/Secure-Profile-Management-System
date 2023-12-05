<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "user_details"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username_input = $_POST['username'];
    $email_input = $_POST['email'];
    $password_input = $_POST['password'];

    try {
        // Create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $sql = "INSERT INTO UserDetails (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $conn->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bindParam(':username', $username_input);
        $stmt->bindParam(':email', $email_input);
        $hashed_password = password_hash($password_input, PASSWORD_DEFAULT); // Hash the password
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();

        echo "Registration successful!";
        // Redirect to the login page after successful registration
        header('Location: login.html');
        exit(); // Ensure no further PHP code is executed
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>