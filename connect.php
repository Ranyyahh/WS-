<?php
$name = $email = $gender = $mobile = $password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $con = new mysqli('localhost', 'root', '', 'RegForm_DB');

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    } else {
        echo "Connection Successful<br>";
    }

    $stmt = $con->prepare("INSERT INTO RegForm_tbl (Name, Email, Gender, Mobile_Phone, Password) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssis", $name, $email, $gender, $mobile, $password);
        if ($stmt->execute()) {
            echo "Data Inserted Successfully!";
        } else {
            echo "Error executing statement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }
    $con->close();
}
?>
