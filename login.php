<?php
session_start();
$username = $_POST["username"];
$password = $_POST["password"];
$_SESSION['username1'] = "$username"; 

// Database connection
$conn = new mysqli('localhost','root','','organ donation');
if($conn->connect_error){
    echo "$conn->connect_error";
    die("Connection Failed : ". $conn->connect_error);
} else {
    
    $stmt = $conn->prepare("select * from users where username = ? and password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt_res = $stmt->get_result();
    if($stmt_res->num_rows > 0){
        header("location: donor.html");
    } else {
        echo '<script>alert("invalid username or password"); location.replace(document.referrer);</script>';
    }
}
?>