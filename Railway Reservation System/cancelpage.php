<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
if (isset($_COOKIE['userid'])) 
{
  $userid = $_COOKIE['userid'];
  $email = $_COOKIE['username'];
}

$host = "localhost";
$username = "sqluser";
$password = "sqluser@001";
$database = "project";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM booking WHERE PASSENGERID = ANY(SELECT PASSENGERID FROM passenger WHERE USERNAME=?)");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
?>

<body style="
      width: 100%;
      height: 100%;
      left: 0%;
      top: 0%;
      position: absolute;
      background: #5576ec;
      overflow: auto;
      "
  >
  <button onclick="redirectTo('profile.php')"
  style="
     width: 16.66%;
      height: 5%;
      left: 83.33%;
      top: 20%;
      position: absolute;
      text-align: center;
      color: #ebff0f;
      font-size: large;
      font-family: Inter;
      font-weight: 800;
      word-wrap: break-word;
      background: black;
      "
  >PROFILE</button>
  <button onclick="redirectTo('station_info.php')"
    style="
      width: 16.66%;
      height: 5%;
      left: 66.66%;
      top: 20%;
      position: absolute;
      text-align: center;
      color: #ebff0f;
      font-size: large;
      font-family: Inter;
      font-weight: 800;
      word-wrap: break-word;
      background: black;
    "
  >STATION INFO</button>
  <button onclick="redirectTo('train_info.php')"
  style="
      width: 16.66%;
      height: 5%;
      left: 49.99%;
      top: 20%;
      position: absolute;
      text-align: center;
      color: #ebff0f;
      font-size: large;
      font-family: Inter;
      font-weight: 800;
      word-wrap: break-word;
      background: black;
    "
  >TRAIN INFO</button>
  <button onclick="redirectTo('cancelpage.php')"
    style="
      width: 16.66%;
      height: 5%;
      left: 33.32%;
      top: 20%;
      position: absolute;
      text-align: center;
      color: #ebff0f;
      font-size: large;
      font-family: Inter;
      font-weight: 800;
      word-wrap: break-word;
      background: black;
    "
  >HISTORY</button>
  <button onclick="redirectTo('bookingpage.php')"
  style="
      width: 16.66%;
      height: 5%;
      left: 16.66%;
      top: 20%;
      position: absolute;
      text-align: center;
      color: #ebff0e;
      font-size: large;
      font-family: Inter;
      font-weight: 800;
      background: black;
    "
  >BOOK TICKETS</button>

  <img
  style="
      width: 10%;
      height: 10%;
      left: 2%;
      top: 2%;
      position: absolute;
      border-radius: 100%;
      "
    src="https://e1.pxfuel.com/desktop-wallpaper/101/88/desktop-wallpaper-indian-railways-logo-indian-government.jpg"
  />
  <button onclick="redirectTo('homepage.php')"
  style="
      width: 16.66%;
      height: 5%;
      left: 0%;
      top: 20%;
      position: absolute;
      text-align: center;
      color: #ebff0f;
      font-size: large;
      font-family: Inter;
      font-weight: 800;
      word-wrap: break-word;
      background: black;
    "
  >HOME</button>
  <div
  style="
      width: 75%;
      height: 0%;
      left: 15%;
      top: 1%;
      position: absolute;
      text-align: center;
      color: #ebff0f;
      font-size: x-large;
      font-family: Inter;
      font-weight: 800;
      word-wrap: break-word;
      "
  >
    IRCTC<br />INDIAN RAILWAY CATERING AND TOURISM CORPORATION
  </div>
  <script>
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>
<table
style="width: 75%;
      height: 0%;
      left: 15%;
      top: 30%;
      position: absolute;
      text-align: center;
      color: #ebff0f;
      font-size: x-large;
      font-family: Inter;
      font-weight: 800;
      word-wrap: break-word;"
>
        <tr>
            <th>BOOKING ID</th>
            <th>PASSENGER ID</th>
            <th>DOB</th>
            <th>BOARDING POINT</th>
            <th>DESTINATION POINT</th>
        </tr>
<?php
if ($result->num_rows > 0) 
{
    while ($row = $result->fetch_assoc()) 
    {
        echo "<tr>";
        echo "<td>" . $row['BOOKINGID'] . "</td>";
        echo "<td>" . $row['PASSENGERID'] . "</td>";
        echo "<td>" . $row['DATEOFBOOKING'] . "</td>";
        echo "<td>" . $row['BOARDINGPOINT'] . "</td>";
        echo "<td>" . $row['DESTINATION'] . "</td>";
        echo "</tr>";
    }
} 
else 
{
    echo "<tr><td colspan='3'>No data found</td></tr>";
}
?>
    </table>


  
</body>

</html>