<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
        $t = $_COOKIE["otp"];
        $opt = $_POST['otp'];
    if($t==$opt)
    {
        header("Location: password.php");
        exit();
    }
    else
    {
        $error = "Otp is incorrect";
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

    <form id="LoginForm" class="login" method="POST" action="otp.php">
        <h1>Reset Password</h1>
        <label for="otp" id="otp" style="margin-left: -30px;">Enter otp:<input type="otp" style="margin-left: 5px;" name="otp" required></label><br><br>
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
