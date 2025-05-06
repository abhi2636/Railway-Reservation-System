<?php
$host = "localhost";
$username = "sqluser";
$password = "sqluser@001";
$database = "project";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM passenger WHERE USERNAME='$username' AND PASSWORD='$password'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1)
    {
        setcookie("userid", $user_id, time() + 3600, "/");
        setcookie("username",$username,time()+3600,"/");
        header("Location: homepage.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="home.css">
    <script src="login.js"></script>
</head>
<body>
    <div id="header">
        <img src="logo.png" alt="logo" id="logo"
        style = "border-radius: 100%">
        <h1 id="title">IRCTC<br>INDIAN RAILWAY CATERING AND TOURISM CORPORATION</h1>
    </div>

    <form id="loginForm" class="login" method="POST">
        <h1>Login</h1>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required autocomplete="on"><br><br>
        <label for="password">Password:</label>&nbsp
        <input type="password" id="password" name="password" required><br><br>
        <div id="errorMsg" class="error"></div>
        <input type="submit" value="Login" id="submit"><br><br>
        <div id="errorMsg" class="error">
            <?php
            if (!empty($error)) {
                echo $error;
            }
            ?>
        </div>
        <br>
        <a href="reset.php" id="reset">Forgot Password?</a>
        <a href="signup.php" id="signup">Sign up</a>
    </form>
</body>
</html>
