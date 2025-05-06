<?php

$host = 'localhost'; // Host name 
$username = 'sqluser'; // Mysql username 
$password = 'sqluser@001'; // Mysql password 
$db_name = 'project'; // Database name 

// Connect to server and select database.
$mysqli = new mysqli($host, $username, $password, $db_name);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $name = $_POST["full_name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $aadhar = $_POST["aadhar"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $password = $_POST["password"];

    $duplicateQuery = "SELECT * FROM passenger WHERE USERNAME='.$username' OR EMAIL_ID='$email' OR MOBILE_NO='$mobile' OR AADHAR_NO='$aadhar'";
    $result = mysqli_query($mysqli, $duplicateQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "User with the same username, email, mobile, or aadhar already exists.";
    } else {

        $insertQuery = "INSERT INTO passenger (USERNAME, FIRST_NAME, EMAIL_ID, MOBILE_NO, AADHAR_NO, DOB, GENDER, PASSWORD)
                        VALUES ('$username', '$name', '$email', '$mobile', '$aadhar', '$dob', '$gender', '$password')";

        if (mysqli_query($mysqli, $insertQuery)) {
            echo "Registration successful!";
            $desiredUrl = "home.php";
            echo"<script>alert('Registration Successful');</script>";
            echo "<script>window.location.href = 'home.php';</script>";
            exit;
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    }

    mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div id="header">
        <img src="logo.png" alt="logo" id="logo" style="border-radius: 100%;">
        <h1 id="title">IRCTC<br>INDIAN RAILWAY CATERING AND TOURISM CORPORATION</h1>
    </div>

    <form id="loginForm" class="login" method="POST">
        <h1>Sign Up</h1>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required autocomplete="on"><br>
        <label for="name" id="name">Name:<input type="text" style="margin-left: 3px;" name="full_name" required></label><br>
        <label for="email" id="email">Email:<input type="email" style="margin-left: 5px;" name="email" required></label><br>

        <label for="mobile" id="mobile">Mobile:<input type="number" style="margin-left: 5px;" name="mobile"></label><br>
<label for="aadhar" id="aadhar" style="margin-left: 23px;">Aadhar:<input type="number" style="margin-left: 5px;" name="aadhar"></label><br>
<label for="dob" id="dob" style="margin-left: -15px;">Date of Birth:<input type="date" style="margin-left: 5px;" name="dob"></label><br>
<label for="gender" id="gender">Gender:
   <label for="male"><input type="radio" id="male" name="gender" value="male">Male</label>
   <label for="female"><input type="radio" id="female" name="gender" value="female">Female</label>
   <label for="other"><input type="radio" id="other" name="gender" value="other">Other</label>
</label><br>

        
        <label for="password">Password:</label>&nbsp
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="submit" id="submit">
        <input type="submit" style="margin-left: 10px;" value="back" id="back"><br><br>
        <script>
        document.getElementById("back").addEventListener("click", function () {
            window.location.href = "home.php";
        });
    </script>
        <br> 
    </form>

    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>
