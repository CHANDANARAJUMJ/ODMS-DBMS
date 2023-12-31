<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : false;
    $birthdate = $_POST["birthdate"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $country = $_POST["country"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $street = $_POST["street"];
    $pincode = $_POST["pincode"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

   

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'organ donation');
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed : " . $conn->connect_error);
    } else {
        // Check if the username is already taken
        $checkUsernameStmt = $conn->prepare("select * from users where username = ?");
        $checkUsernameStmt->bind_param("s", $username);
        $checkUsernameStmt->execute();
        $checkUsernameResult = $checkUsernameStmt->get_result();

        if ($checkUsernameResult->num_rows > 0) {
            echo '<script>alert("Username already exists, try different or login"); location.replace(document.referrer);</script>';
            
        } else {
            // Insert user data into the 'users' table
            $insertStmt = $conn->prepare("insert into users (firstname, lastname, gender, birthdate, age, email, username, phone, country, state, city, street, pincode, password)
                values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $insertStmt->bind_param("ssssisssssssss", $firstName, $lastName, $gender, $birthdate, $age, $email, $username, $phone, $country, $state, $city, $street, $pincode, $password);
            
            if ($insertStmt->execute()) {
                if($password != $confirmPassword){
                    echo '<script>alert("password not matched"); location.replace(document.referrer);</script>';
                }
                else{
                    echo "<h3>User registered successfully!</h3>";
                // You can redirect to a success page if needed
                }
                
            } else {
                echo "<h3>Error: " . $insertStmt->error . "</h3>";
            }
        }

        // Close the database connection
        $conn->close();
    }
} else {
    // Redirect back to the sign-up page if accessed directly
    header("Location: login.html");
}
?>