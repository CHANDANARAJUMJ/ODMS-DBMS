<!-- PHP code to establish connection with the localserver -->
<?php

// Username is root
$user = 'root';
$password = '';

// Database name is geeksforgeeks
$database = 'organ donation';

// Server is localhost with
// port number 3306
$servername='localhost';
$mysqli =new mysqli('localhost','root','','organ donation');

// Checking for connections
if ($mysqli->connect_error) {
	die('Connect Error (' .
	$mysqli->connect_errno . ') '.
	$mysqli->connect_error);
}

// SQL query to select data from database
$sql = " SELECT * FROM users ORDER BY firstname DESC ";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>User Details</title>
	<!-- CSS FOR STYLING THE PAGE -->
	<style>
		*{
    padding: 0px;
    margin: 0px;
}
body{
    color:  #1e3a69;
    font-family: 'Kurale', sans-serif;
	background-image: url(signup.jpg);
    height: 1000px;
}
nav {
    background-color:rgb(84, 161, 146); /* light blue */
    padding: 10px;
	width: 1496px;
}

nav button {
    text-decoration: none;
    font-family: 'Kurale', sans-serif;
    color:  #eef1f7;
    position: "right";
    padding: 9px 17px;
    background-color:rgb(84, 161, 146);
    border-color:rgb(84, 161, 146);
    border-radius: 9px;
    background-size: cover;
}
		table {
			margin: 0 auto;
			font-size: small;
			padding: 20px;
			border: 3px rgb(84, 161, 146);
			border-color:rgb(84, 161, 146);
		}

		h1 {
			text-align: center;
			color: #1e3a69;
			font-size: large;
			padding: 40px;
			font-family: 'Kurale', sans-serif;
		}

		td {
			background-color:  rgb(229, 245, 242);
			border: 3px;
			border-color:rgb(84, 161, 146);
		}

		th,
		td {
			font-weight: bold;
			border: 3px rgb(84, 161, 146);
			border-color:rgb(84, 161, 146);
			padding: 10px;
			text-align: center;
		}

		td {
			font-weight: lighter;
		}
	</style>
</head>
<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kurale&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

<body>
<nav>
        <button onclick="window.location.href='home.html'">Home</button>
        <button onclick="window.location.href='admin.html'">Admin</button>
        <button onclick="window.location.href='aboutus.html'">About Us</button>
        <button onclick="window.location.href='login.html'">Login</button>
        <button onclick="window.location.href='Contactus.html'">Contact Us</button>
    </nav>
	<section>
		<h1>USER DATA</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>First name</th>
				<th>Last name</th>
				<th>Gender</th>
				<th>Birth date</th>
                <th>Age</th>
                <th>Email id</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Country</th>
                <th>State</th>
                <th>City</th>
                <th>pincode</th>
                <th>Password</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php 
				// LOOP TILL END OF DATA
				while($rows=$result->fetch_assoc())
				{
			?>
			<tr>
				<!-- FETCHING DATA FROM EACH
					ROW OF EVERY COLUMN -->
				<td><?php echo $rows['firstname'];?></td>
				<td><?php echo $rows['lastname'];?></td>
				<td><?php echo $rows['gender'];?></td>
				<td><?php echo $rows['birthdate'];?></td>
                <td><?php echo $rows['age'];?></td>
                <td><?php echo $rows['email'];?></td>
                <td><?php echo $rows['username'];?></td>
                <td><?php echo $rows['phone'];?></td>
                <td><?php echo $rows['country'];?></td>
                <td><?php echo $rows['state'];?></td>
                <td><?php echo $rows['city'];?></td>
                <td><?php echo $rows['pincode'];?></td>
                <td><?php echo $rows['password'];?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>
