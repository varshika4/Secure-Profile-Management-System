<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "user_details"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username_input = $_POST['username'];
    $password_input = $_POST['password'];

    try {
        // Create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL to fetch user details by username
        $sql = "SELECT username, password FROM UserDetails WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username_input);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the password
            if (password_verify($password_input, $user['password'])) {
                // Password verified, login successful
                $response = array('success' => true, 'message' => 'Login successful!');
                echo json_encode($response);
                // Redirect to the profile page after successful login
                // header('Location: profile.html');
                // exit(); // Ensure no further PHP code is executed
            } else {
                // Incorrect password, throw an error
                $response = array('success' => false, 'message' => 'Invalid credentials!');
                echo json_encode($response);
            }
        } else {
            // Username not found, throw an error
            $response = array('success' => false, 'message' => 'Invalid credentials!');
            echo json_encode($response);
        }
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>