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

$selectedClass = $_POST["selectedClass"];
$train_id=$_POST["train_id"];
// Use single quotes and escape the variables properly in your SQL query.
$stmt = $mysqli->prepare("SELECT DISTINCT COACH_ID FROM assigned_to_train NATURAL JOIN COACH WHERE TRAIN_ID = ? AND COACH_TYPE = ?");
$stmt->bind_param("ss", $train_id, $selectedClass);

// Execute the statement
$stmt->execute();

// Bind the result
$stmt->bind_result($coach_id);

echo "<option value='' disabled selected hidden>Please Choose...</option>";

while ($stmt->fetch()) {
    echo '<option value="' . $coach_id . '">' . $coach_id . '</option>';
}

// Close the prepared statement
$stmt->close();
?>


