<?php
session_start();
$host = "localhost";
$username = "sqluser";
$password = "sqluser@001";
$db_name = "project";
// Connect to server and select database.
$mysqli = new mysqli($host, $username, $password, $db_name);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$flag = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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
  <button   onclick="redirectTo('station_info.php')"
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
  <button   onclick="redirectTo('train_info.php')"
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
  <button   onclick="redirectTo('cancelpage.php')"
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
  <button   onclick="redirectTo('bookingpage.php')"
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
  <button   onclick="redirectTo('homepage.php')"
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
  >
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
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<select
          style="
            width: 19%;
            height: 3%;
            left: 10.5%;
            top: 31%;
            position: absolute;
            background: white;
          "
          name = "source"
          id="source"
        >
        <?php
        $sql = "SELECT station_id, station_name FROM Stations";
        $result = $mysqli->query($sql);
        echo "<option value='' disabled selected hidden>Please Choose...</option>";

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row["station_name"]."'>".$row["station_name"]."</option>";
            }
        } else {
            echo "0 results";
        }
        ?>
      </select>

        <label
          style="
            width: 20%;
            height: 5%;
            left: 3%;
            top: 30%;
            position: absolute;
            color: #ebff0f;
            font-size: x-large;
            font-family: Inter;
            font-weight: 900;
            word-wrap: break-word;
          "
        >
          FROM:
        </label>
        <select
          style="
            width: 19%;
            height: 3%;
            left: 36.5%;
            top: 31%;
            position: absolute;
            background: white;
          "
          name="destination"
          id="destination"
        >
        <?php
        $sql = "SELECT station_id, station_name FROM Stations";
        $result = $mysqli->query($sql);
        echo "<option value='' disabled selected hidden>Please Choose...</option>";
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<option value='".$row["station_name"]."'>".$row["station_name"]."</option>";
            }
        } else {
            echo "0 results";
        }
        ?>
</select>
        <label
          style="
            height: 5%;
            left: 32%;
            top: 30%;
            position: absolute;
            color: #ebff0f;
            font-size: x-large;
            font-family: Inter;
            font-weight: 900;
            word-wrap: break-word;
          "
        >
          TO:
        </label>
        <input type="date"
        style="
            width: 19%;
            height: 3%;
            left: 64.5%;
            top: 31%;
            position: absolute;
            background: white;;
          "
        name="date" id="date" />

        <label
          style="
            height: 5%;
            left: 57.5%;
            top: 30%;
            position: absolute;
            color: #ebff0f;
            font-size: x-large;
            font-family: Inter;
            font-weight: 900;
            word-wrap: break-word;
          "
        >
          DATE:
        </label>
        <button
        type="submit"
        style="
      width: 10%;
      height: 3%;
      left: 85%;
      top: 31%;
      position: absolute;
      text-align: center;
      color: black;
      font-size: small;
      font-family: Inter;
      font-weight: 400;
      word-wrap: break-word;
"
    name="Submit"
    id="Submit">
        SUBMIT</button>
        
</form>
<script>
  // Get the current date
  const currentDate = new Date();
  
  // Calculate the maximum date (6 months from current date)
  const maxDate = new Date(currentDate);
  maxDate.setMonth(maxDate.getMonth() + 6);

  // Format the dates as "YYYY-MM-DD"
  const currentDateString = currentDate.toISOString().split('T')[0];
  const maxDateString = maxDate.toISOString().split('T')[0];

  // Set the 'min' and 'max' attributes of the input element
  document.getElementById('date').min = currentDateString;
  document.getElementById('date').max = maxDateString;
</script>






<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
          $flag=1;
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["source"]) && isset($_POST["destination"]) && isset($_POST["date"])) {
        // Get the selected date from the form
        $selectedDate = $_POST["date"];
        $sources=$_POST["source"];
        $destination=$_POST["destination"];
        $today = date('Y-m-d');
        $sixMonthsFromNow = date('Y-m-d', strtotime('+6 months'));
        if ($selectedDate < $today) {
            echo "<script>alert('Please select a date on or after today.');</script>";
        }  elseif($selectedDate > $sixMonthsFromNow) {
          echo "<script>alert('Please select a date within the next 6 months.');</script>";
        }
        else{
         $sql="
          (SELECT A.train_id,C.train_name,A.arrival_time as source,B.arrival_time as reach
          FROM schedule A, schedule B ,trains C
          WHERE A.station_id=(SELECT STATION_ID FROM stations WHERE STATION_NAME='$sources') 
          AND B.station_id=(SELECT STATION_ID FROM stations WHERE STATION_NAME='$destination') 
          AND A.train_id=B.train_id
          And B.train_id=C.train_id
          AND A.station_sequence<B.station_sequence 
          AND FIND_IN_SET(DAYNAME('$selectedDate'), A.days_of_operation) > 0);";
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
          </style>
          ";
            echo "<div class='sd'>";
            echo "<table
            style='width: 100%
              marginleft:20%;
              marginright:20%'>";
              
            echo "<tr><th>TRAIN ID</th><th>TRAIN NAME</th><th>SOURCE ARRIVAL</th><th>DESTINATION ARRIVAL</th></tr>";
            while ($row = $result->fetch_assoc()) {
              echo "<tr onclick='redirectToTicketPage(" . $row["train_id"] . ", \"" . $selectedDate . "\", \"" . $sources . "\", \"" . $destination . "\")'>";
                echo "<td>" . $row["train_id"] . "</td>";
                echo "<td>" .$row["train_name"] ."</td>";
                echo "<td>" . $row["source"] . "</td>";
                echo "<td>" . $row["reach"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<div>"; 
        } else {
          echo "<script>alert('No Result Found.');</script>";
        }
        }
    }
    elseif($flag==1){
      echo "<script>alert('Please provide all parameters.');</script>";
    }
    ?>
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
        function redirectToTicketPage(trainId, selectedDate, sources, destination) {
    
    document.cookie = "train_id=" + trainId;
    document.cookie = "date=" + selectedDate;
    document.cookie = "source=" + sources;
    document.cookie = "destination=" + destination;

    // Redirect to ticketpage.php
    window.location.href = 'ticketpage.php';
}

    </script>
<?php
$mysqli->close();
?>
</body>
</html>
