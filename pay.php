<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "final_project";

try {
   
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $sql = "INSERT INTO payments (firstname, lastname, emailaddress, cardnumber, cvc, amount) 
        VALUES (:firstname, :lastname, :emailaddress, :cardnumber, :cvc, :amount)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':firstname', $firstName);
        $stmt->bindParam(':lastname', $lastName);
        $stmt->bindParam(':emailaddress', $emailAddress);
        $stmt->bindParam(':cardnumber', $cardNumber);
        $stmt->bindParam(':cvc', $cvc);
        $stmt->bindParam(':amount', $amount);

        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $emailAddress = $_POST['emailaddress'];
        $cardNumber = $_POST['cardnumber'];
        $cvc = $_POST['cvc'];
        $amount = $_POST['amount'];

        $stmt->execute();

        header("Location: dashboard.html");
        exit();
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
