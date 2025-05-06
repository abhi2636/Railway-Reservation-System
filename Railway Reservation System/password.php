<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_COOKIE["email"];
    $pass = $_POST['password'];
    $host = "localhost";
    $username = "sqluser";
    $password = "sqluser@001";
    $database = "project";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE passenger SET PASSWORD = ? WHERE EMAIL_ID = ?");
    $stmt->bind_param("ss", $pass, $email);
    if ($stmt->execute()) 
    {
        $error = "Password changed successfully";
    } else {
        $error = "Password is incorrect";
    }
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

    <form id="LoginForm" class="login" method="POST" action="password.php">
        <h1>Reset Password</h1>
        <label for="password" id="password" style="margin-left: -30px;">Enter Password:<input type="password" style="margin-left: 5px;" name="password" required></label><br><br>
        <input type="submit" value="submit" id="submit">
        </script>
        <input type="submit" style="margin-left: 10px;" value="back" id="back"><br><br>
        <script>
        document.getElementById("back").addEventListener("click", function () {
            window.location.href = "home.php";
        });
    </script>
    <?php
            if (!empty($error)) {
                echo $error;
            }
            ?>
        <br>
    </form>
</body>
</html>
