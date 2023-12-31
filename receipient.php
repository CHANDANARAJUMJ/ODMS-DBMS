<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $patientName = $_POST["patient_name"];
    $age = $_POST["age"];
    $blood = $_POST["blood"];
    $organReq = $_POST["organ_req"];
    $history = $_POST["history"];
    $donHistory = $_POST["don_history"];
    $phyDisabled = $_POST["phy_disabled"];
    $smoking = $_POST["smoking"];
    $alcohol = $_POST["alcohol"];
    $emailId = $_POST["email_id"];
    $phoneNo = $_POST["phone_no"];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'organ donation');
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed : " . $conn->connect_error);
    } else {
        // Insert user data into the 'recipients' table
        $insertStmt = $conn->prepare("insert into receipient (patient_name, age, blood, organ_req, history, don_history, phy_disabled, smoking, alcohol, email_id, phone_no)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $insertStmt->bind_param("sisssssssss", $patientName, $age, $blood, $organReq, $history, $donHistory, $phyDisabled, $smoking, $alcohol, $emailId, $phoneNo);

        if ($insertStmt->execute()) {
            header("Location: home.html");
            // You can redirect to a success page if needed
        } else {
            echo "<h3>Error: " . $insertStmt->error . "</h3>";
        }

        // Close the database connection
        $conn->close();
    }
} else {
    // Redirect back to the sign-up page if accessed directly
    header("Location: home.html");
}
?>