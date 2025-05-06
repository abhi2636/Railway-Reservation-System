<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
    $train_id = $_COOKIE['train_id'];
    $selectedDate = date('Y-m-d', strtotime($_COOKIE['date']));
    $destination = $_COOKIE['destination'];
    $sources = $_COOKIE['source'];
    $Class=$_COOKIE['selectedClass'];
    $Coach=($_COOKIE['selectedCoach']);

    echo "User ID: " . $userid;
} else {
    // Handle the case where 'userid' cookie is not set
    echo "User ID not found in the cookie.";
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
  >CANCELLATION</button>
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


  
</body>

</html>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $inputCount = isset($_POST['inputCount']) ? intval($_POST['inputCount']) : 0;
    $host = "localhost";
$username = "sqluser";
$password = "sqluser@001";
$db_name = "project";

// Connect to server and select database.
  $mysqli = new mysqli($host, $username, $password, $db_name);


    if ($mysqli->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
    echo"gvdfgfdgdfg";
    $inputCount = $_POST["inputCount"];
    $passengerData = array();


  for ($i = 1; $i <= $inputCount; $i++) {
      $name = $_POST["name_$i"];
      $gender = $_POST["gender_$i"];
      $age = $_POST["age_$i"];

      // Store the data in an array
      $passengerData[] = array("name" => $name, "gender" => $gender, "age" => $age);
  }

  $sql="Insert Into booking(PassengerID,TrainNumber,DateOfBooking,TravelDate,NO_OF_PASSENGERS,BoardingPoint,Destination) VALUES ($userid, $train_id, CURDATE(), '$selectedDate', $inputCount, '$sources', '$destination')";
  if ($mysqli->query($sql) === TRUE) {
    $booking_id = $mysqli->insert_id; // Retrieve the last inserted booking ID
    echo "Record inserted successfully. Booking ID: " . $booking_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$query = "SELECT SEAT_ID FROM
  (
      SELECT SEAT_ID FROM assigned_to_train
      WHERE train_ID = '$train_id' AND coach_ID = '$Coach'
      
      EXCEPT
      
      SELECT SEAT_ID FROM booking
      JOIN seat_reservation ON booking.BookingID = seat_reservation.BookingID
      WHERE TravelDate = '$selectedDate' AND TrainNumber = '$train_id' AND Coach_ID = '$Coach'
  ) AS SeatDifference
  LIMIT $inputCount";

$result = $mysqli->query($query);

if ($result) {
    $seatIDs = array();

    while ($row = $result->fetch_assoc()) {
        $seatIDs[] = $row['SEAT_ID'];
    }

    foreach ($passengerData as $passenger) {
        $name = $passenger["name"];
        $gender = $passenger["gender"];
        $age = $passenger["age"];

        // Use the retrieved $seatID in the INSERT query
        if (!empty($seatIDs)) {
            $seatID = array_shift($seatIDs); // Take the next available seat ID

            $insertQuery = "INSERT INTO seat_reservation (BookingID, PASSENGERNAME, GENDER, AGE, TRAIN_ID, COACH_ID, SEAT_ID) VALUES ($booking_id, '$name', '$gender', $age, $train_id, '$Coach', $seatID)";

            if ($mysqli->query($insertQuery)) {
                echo "Data inserted successfully with SEAT_ID: " . $seatID . "<br>";
            } else {
                echo "Error in insertion with SEAT_ID: " . $seatID . ": " . $mysqli->error . "<br>";
            }
        } else {
            echo "No available seat IDs for this passenger.<br>";
        }
    }

    $result->close();
} else {
    echo "Error in the query: " . $mysqli->error;
}

    }
    $mysqli->close();
}
?>