<?php 
session_start();
session_id();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$username = $_SESSION['username1']; 
echo "$username";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
   // $username=$_POST['username'];
    $organDonated = $_POST["organ_donated"];
    $reasonOfDonation = $_POST["reason_of_donation"];
    $history = $_POST["history"];
    $donHistory = $_POST["don_history"];
    $phyDisabled = $_POST["phy_disabled"];
    $smoking = $_POST["smoking"];
    $alcohol = $_POST["alcohol"];
    $blood = $_POST["blood"];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'organ donation');
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed : " . $conn->connect_error);
    } else {
        // Insert user data into the 'donors' table
        $insertStmt = $conn->prepare("insert into donor (username ,organ_donated, reason_of_donation, history, don_history, phy_disabled, smoking, alcohol, blood)
            values (?,?, ?, ?, ?, ?, ?, ?, ?)");

        $insertStmt->bind_param("sssssssss",$username, $organDonated, $reasonOfDonation, $history, $donHistory, $phyDisabled, $smoking, $alcohol, $blood);

        if ($insertStmt->execute()) {
            echo '<script>alert("Data submitted successfully"); location.replace(document.referrer);</script>';
            header("Location: home.html");
            // You can redirect to a success page if needed
        } else {
            echo "<h3>Error: " . $insertStmt->error . "</h3>";
        }

        // Close the database connection
        $conn->close();
    }
} else {
    //Redirect back to the sign-up page if accessed directly
    header("Location: home.html");
}
?>