<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = $_POST['email'];
$host = "localhost";
$username = "sqluser";
$password = "sqluser@001";
$database = "project";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM passenger WHERE email_id = ?");
$stmt->bind_param("s", $to);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $subject = 'Opt Code to reset password';
    $optCode = rand(10000,99999);
    $message = "Your otp code is: $optCode";    
    $headers = "From: 22pc02@psgtech.ac.in\r\n";
    $mailSent = mail($to, $subject, $message, $headers);
    setcookie("otp", $optCode, time() + 3600, "/");
    setcookie("email", $to, time() + 3600, "/");
    header("Location: otp.php");
    exit();
} else {
    $error= "Email does not exist in the database.";
}

$stmt->close();
$conn->close();
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

    <form id="LoginForm" class="login" method="POST" action="reset.php">
        <h1>Reset Password</h1>
        <label for="email" id="email" style="margin-left: -30px;">Enter email:<input type="email" style="margin-left: 5px;" name="email" required></label><br><br>
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
