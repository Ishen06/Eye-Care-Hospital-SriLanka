<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "final_project";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_Name = $_POST['first_name'];
    $last_Name = $_POST['last_name'];
    $phone_Number = $_POST['phone_number'];
    $email_Address = $_POST['email_address'];
    $appointment_Date = $_POST['appointment_date'];
    $visited_Before = isset($_POST['yes']) ? "Yes" : "No";
    $number_hours = $_POST['number_hours'];
    $comment = $_POST['comment'];

    if (isset($_POST['appointment_time']) && !empty($_POST['appointment_time'])) {

        $appointment_Time = $_POST['appointment_time'];

        $sql = "INSERT INTO appointments (first_name, last_name, phone_number, email_address, appointment_date, 
        visited_before, number_hours, comment, appointment_time) VALUES ('$first_Name', '$last_Name', '$phone_Number',
        '$email_Address', '$appointment_Date', '$visited_Before', '$number_hours', '$comment', '$appointment_Time')";

        if ($conn->query($sql) === TRUE) {
            header("Location: pay.html");
                exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();

?>