<?php
// Database connection parameters
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "final_project"; // Change this to your database name

// Establish a PDO database connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($new_password === $confirm_password) {
        // Hash the password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        try {
            // Prepare and execute the SQL statement to update the password
            $stmt = $conn->prepare("UPDATE user SET Password = :new_password WHERE EmailAddress = :username");
            $stmt->bindParam(':new_password', $hashed_password);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

           // echo "Password updated successfully!";
           header("Location: login.html");
                exit();
        } catch (PDOException $e) {
            echo "Error updating password: " . $e->getMessage();
        }
    } else {
        echo "Passwords do not match. Please try again.";
    }
}

// Close the database connection
$conn = null;
?>