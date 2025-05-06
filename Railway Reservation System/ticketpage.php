<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script>
        function redirectTo(url) {
            window.location.href = url;
        }
        </script>
    
    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin ="anonymous"></script>

</head>



<?php
// Check if the 'userid' cookie is set
if (isset($_COOKIE['selectedClass'])) {
  unset($_COOKIE['selectedClass']);
  unset($_COOKIE['selectedCoach']);
}
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
    $train_id = $_COOKIE['train_id'];
    $selectedDate = date('Y-m-d', strtotime($_COOKIE['date']));
    $destination = $_COOKIE['destination'];
    $sources = $_COOKIE['source'];
    echo $selectedDate;

    echo "User ID: " . $userid;
} else {
    // Handle the case where 'userid' cookie is not set
    echo "User ID not found in the cookie.";
}
?>



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
  >PROFILE
  </button>
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
  >STATION INFO
  </button>
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
  >TRAIN INFO
  </button>
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
  >HISTORY
  </button>
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
  >BOOK TICKETS
  </button>

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
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
    <div class="form-group">


  <select class="form-control" id="Class"
            style="width: 10%; height: 3%; left: 12%; top: 30%; position: absolute; background: white;"
            name="Class"
            >
            <?php
            $sql = "SELECT DISTINCT COACH_TYPE FROM coach NATURAL JOIN assigned_to_train WHERE train_id =".$train_id;
            $result=$mysqli->query($sql);
            echo "<option value='' disabled selected hidden>Please Choose...</option>";
            while($row = mysqli_fetch_array($result))
            {
                ?>
                <option value="<?php echo $row['COACH_TYPE'];?>"><?php echo $row['COACH_TYPE'];?></option>

                
                <?php
            }

            ?>
</select>

        </div>
            <div class="form-group">
            <style>
      select:invalid { color: gray; }
  </style>
        <select class='form-control'
            style="width: 10%; height: 3%; left: 32%; top: 30%; position: absolute; background: white;"
            name="Coach"
            id="Coach">
            
</select>

</div>

<script type="text/javascript">
    $(document).ready(function() {
    // Function to set a cookie
    function setCookie(name, value) {
        document.cookie = name + '=' + value;
    }

    // Function to get the value of a cookie
    function getCookie(name) {
        var cookieName = name + '=';
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.indexOf(cookieName) === 0) {
                return cookie.substring(cookieName.length, cookie.length);
            }
        }
        return '';
    }

    $('#Class').on('change', function() {
        var selectedClass = this.value;
        var train_id = '<?php echo $train_id; ?>';

        // Set selectedClass as a cookie
        setCookie('selectedClass', selectedClass);

        $.ajax({
            url: 'getCoach.php',
            type: 'POST',
            data: {
                'selectedClass': selectedClass,
                'train_id': train_id
            },
            cache: false,
            success: function(data) {
                $('#Coach').html(data);

                // Display the selected class immediately
            }
        });
    });

    $('#Coach').on('change', function() {
        var selectedCoach = this.value;

        // Display the selected Coach
        

        // Set selectedCoach as a cookie
        setCookie('selectedCoach', selectedCoach);

        $.ajax({
          type: 'POST', // or 'GET' depending on your server-side script
          url: 'process.php', // Replace with the path to your PHP script
          data: { selectedCoach: selectedCoach },
          success: function(response) {
            // Display the response (a number) directly
            $('#selectedValues').append('  Available Seats: ' + response);
          }
        });



    });

    // Retrieve and display cookies when the page loads
    
});



</script>



        
          <style>
          select:invalid { color: gray; }
          </style>
          
  
 </form>

 <form action="success_page.php" method="post" id="inputForm">
  <div id="inputContainer"></div>
  <button style="width: 10%; height: 3%; left: 45%; top: 30%; position: absolute; background: white;" type="button" id="addInput">Add Input</button>
  <input style="width: 10%; height: 3%; left: 60%; top: 30%; position: absolute; background: white;" type="submit" name="submit" value="Submit">
  <input type="hidden" id="inputCount" name="inputCount" value="0">
</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const maxInputs = 5;
  const inputContainer = document.getElementById("inputContainer");
  const addInputButton = document.getElementById("addInput");
  const inputCountField = document.getElementById("inputCount");
  let inputCount = 0;

  addInputButton.addEventListener("click", function() {
    if (inputCount < maxInputs) {
      inputCount++;
      const inputRow = createInputRow(inputCount);
      inputContainer.appendChild(inputRow);
      inputRow.scrollIntoView({ behavior: "smooth" });
    } else {
      alert("You've reached the maximum limit of input fields.");
    }
  });

  function createInputRow(count) {
    const inputRow = document.createElement("div");
    inputRow.className = "inputRow";

    inputRow.style.position = "relative";  // Set position to "relative" for positioning

    inputRow.style.padding = "10px";
    inputRow.style.border = "1px solid #ccc";
    inputRow.style.top = `250px`; // Adjust the value as needed
    inputRow.style.left = "0";

    const label = document.createElement("label");
    label.textContent = `Passenger ${count}:`;

    const nameInput = createInputElement("text", `name_${count}`, "Name");
    const genderSelect = createSelectElement(`gender_${count}`, ["Male", "Female", "Other"]);
    const ageInput = createInputElement("text", `age_${count}`, "Age");
    

    inputRow.appendChild(label);
    inputRow.appendChild(nameInput);
    inputRow.appendChild(genderSelect);
    inputRow.appendChild(ageInput);

    if (inputCount > 0) {
      const deleteButton = createDeleteButton(inputRow);
      inputRow.appendChild(deleteButton);
    }

    return inputRow;
  }

  function createInputElement(type, name, placeholder) {
    const input = document.createElement("input");
    input.type = type;
    input.name = name;
    input.placeholder = placeholder;
    return input;
  }

  function createSelectElement(name, options) {
    const select = document.createElement("select");
    select.name = name;
    for (const option of options) {
      const optionElement = document.createElement("option");
      optionElement.value = option;
      optionElement.textContent = option;
      select.appendChild(optionElement);
    }
    return select;
  }

  function createDeleteButton(inputRow) {
    const deleteButton = document.createElement("button");
    deleteButton.className = "deleteInput";
    deleteButton.textContent = "Delete";
    deleteButton.addEventListener("click", function() {
      inputContainer.removeChild(inputRow);
      inputCount--;
      updatePassengerLabels();
    });
    return deleteButton;
  }

  function updatePassengerLabels() {
    const inputRows = document.querySelectorAll(".inputRow");
    inputRows.forEach((row, index) => {
      const passengerLabel = row.querySelector("label");
      passengerLabel.textContent = `Passenger ${index + 1}:`;
    });
  }
  
  document.getElementById("inputForm").addEventListener("submit", function() {
    document.getElementById("inputCount").value = inputCount;

    if (inputCount === 0) {
      alert("Please add at least one passenger.");
      event.preventDefault(); // Prevent form submission
    }
  });
});
</script>


<?php
echo $train_id;
?>


 
<div id="selectedValues" style="width: 50%; height: 3%; left: 40%; top: 40%; position: absolute; color: black; font-size: medium;"></div>


<?php

?>

 
</body>

<?php
$mysqli->close();
?>

</html>