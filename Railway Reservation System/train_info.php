<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
// Check if the 'userid' cookie is set
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
    echo "User ID: " . $userid;
} else {
    // Handle the case where 'userid' cookie is not set
    echo "User ID not found in the cookie.";
}
?>


<?php
$host = "localhost";
$username = "sqluser";
$password = "sqluser@001";
$db_name = "project";

// Connect to server and select database.
$mysqli = new mysqli($host, $username, $password, $db_name);
$host = "localhost";
$username = "sqluser";
$password = "sqluser@001";
$database = "project";
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
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
  <button   onclick="redirectTo('profile.php')"
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


  <style>
      select:invalid { color: gray; }
  </style>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <select style='
        width: 38%;
        height: 3%;
        left: 39.5%;
        top: 30%;
        position: absolute;
        background: white;
    ' name='Train' id='Train'>
    <?php
        $sql = "SELECT train_name FROM trains";
        $result = $mysqli->query($sql);
        echo "<option value='' disabled selected hidden>Please Choose...</option>";

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row["train_name"]."'>".$row["train_name"]."</option>";
            }
        } else {
            echo "0 results";
        }
        ?>
        
    </select>
    <button type="submit" style="
        width: 10%;
        height: 3%;
        left: 80%;
        top: 30%;
        position: absolute;
        color: black;
        font-size: small;
        font-family: Inter;
        font-weight: 700;
        word-wrap: break-word;
    ">Submit</button>
</form>
     <label
          style="
            width: 30%;
            height: 5%;
            left: 26%;
            top: 30%;
            position: absolute;
            color: #ebff0f;
            font-size: large;
            font-family: Inter;
            font-weight: 900;
            word-wrap: break-word;
          "
        >
          TRAIN NAME:
        </label>
  
  <script>
        function redirectTo(url) {
            window.location.href = url;
        }
    </script>
  <?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Train'])) {
   $train=$_POST['Train'];
    

   $sql = "SELECT station_id,arrival_time, departure_time, station_name ,days_of_operation
   FROM schedule 
   NATURAL JOIN trains 
   NATURAL JOIN stations 
   WHERE train_name = '$train'
   order by station_sequence";
  $result = $mysqli->query($sql);

    if ($result && $result->num_rows > 0) {
        echo"<style>
        .table-container {
          position: absolute;
          top: 50%;
        }
        
        table {
          width: 100%;
          border-collapse: collapse;
        }
        
        th, td {
          padding: 8px; /* Adjust the padding to suit your design */
          text-align: left;
          border-bottom: 1px solid #ddd; /* 1% changed to 1px for the border */
        }
        
        th {
          background-color: #f2f2f2;
          font-size: 16px;
          white-space: nowrap; /* Prevent text from wrapping */
        }
        
        tr:nth-child(even) {
          background-color: #f9f9f9;
        }
        
        tr:nth-child(odd) {
          background-color: #9f9f9f;
        }
        
        .sd {
          position: absolute;
          top: 40%;
          width: 100%;
        }
      </style>";
        echo "<div class='sd'>";
        echo "<table
        style='width: 100%
          marginleft:20%;
          marginright:20%'>";
        echo "<tr><th>STATION ID</th><th>STATION NAME</th><th>ARRIVAL</th><th>DEPARTURE</th><th>DAYS OF OPERATION</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["station_id"] . "</td>";
            echo "<td>" . $row["station_name"] . "</td>";
            echo "<td>" . $row["arrival_time"] . "</td>";
            echo "<td>" . $row["departure_time"] . "</td>";
            echo "<td>" . $row["days_of_operation"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<div>";
    } else {
        echo "No results found.";
    }
}
?>
<?php
$mysqli->close();
?>

    


  
</body>

</html>