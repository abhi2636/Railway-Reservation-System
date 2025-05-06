<?php
$host = "localhost";
$username = "sqluser";
$password = "sqluser@001";
$db_name = "project";

// Connect to server and select database.
$mysqli = new mysqli($host, $username, $password, $db_name);

if ($mysqli->connect_error) {
   die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['selectedCoach'])) {
  $selectedCoach = $mysqli->real_escape_string($_POST['selectedCoach']); // Sanitize the input

  $userid = $mysqli->real_escape_string($_COOKIE['userid']);
  $train_id = $mysqli->real_escape_string($_COOKIE['train_id']);
  $selectedDate = $mysqli->real_escape_string($_COOKIE['date']);
  $destination = $mysqli->real_escape_string($_COOKIE['destination']);
  $sources = $mysqli->real_escape_string($_COOKIE['source']);

  // Prepare the SQL statement with variables directly in the query
  $sql = "SELECT COUNT(*) FROM
  (
      SELECT SEAT_ID FROM assigned_to_train
      WHERE train_ID = $train_id AND coach_ID = '$selectedCoach'
      
      EXCEPT
      
      SELECT SEAT_ID FROM booking
      NATURAL JOIN seat_reservation
      WHERE TravelDate = '$selectedDate' AND TrainNumber = $train_id AND Coach_ID = '$selectedCoach'
  ) AS SeatDifference";

  // Execute the statement
  $result = $mysqli->query($sql);

  

  $row = $result->fetch_assoc();
  $count = $row["COUNT(*)"];

  // Output the count
  echo $count;
} else {
  echo 'No data received';
}
?>