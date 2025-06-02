<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "final_project";

try {
  
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['EmailAddress'];
        $password = $_POST['Password'];

        $stmt = $conn->prepare("SELECT Password FROM user WHERE EmailAddress = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
          
            if (password_verify($password, $result['Password'])) {
                header("Location: dashboard.html");
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Invalid email or password.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>


