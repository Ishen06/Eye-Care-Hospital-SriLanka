<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final_project";

try {
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        if (isset($_POST['EmailAddress']) && isset($_POST['Password'])) {
            $email = $_POST['EmailAddress'];
            $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO user (EmailAddress, Password) VALUES (:email, :password)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            $stmt->execute();

            header("Location: login.html");
            exit();
        } else {
            echo "Please fill in both fields.";
        }
    }
} catch (PDOException $e) {
    if ($e->getCode() == 23000) { 
        echo "This email address is already registered.";
    } else {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>


