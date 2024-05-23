<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our eventcategories</title>
  <style>
    /* CSS styles */
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }

    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }

    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }

    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */
      padding: 8px;
    }

    header {
      background-color: skyblue;
    }

    section {
      padding: 71px;
      border-bottom: 1px solid #ddd;
    }

    footer {
      text-align: center;
      padding: 15px;
      background-color: skyblue;
    }

  </style>
  <!-- JavaScript validation and content load for insert data-->
  <script>
    function confirmInsert() {
      return confirm('Are you sure you want to insert this record?');
    }
  </script>
</head>
<body bgcolor="red">
<header>
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
      <img src="./images/logo.jpg" width="90" height="60" alt="Logo">
    </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Service.html">SERVICE</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./organizer.php">ORGANIZER</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./events.php">EVENTS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./eventsessions.php">EVENTSESSIONS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./eventregistrations.php">EVENTREGISTRATIONS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./eventcategories.php">EVENTCATEGORIES</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./attendees.php">ATTENDEES</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">FEEDBACK</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./networking_opportunities.php">NETWORKINGOPPORTUNITIES</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./profiles.php">PROFILES</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
    <br><br>
  </ul>
</header>
<section>
  <h1><u> eventcategories Form </u></h1>
  <form method="post" onsubmit="return confirmInsert();">
    <label for="cid">eventcategory_id:</label>
    <input type="number" id="cid" name="cid"><br><br>

    <label for="en">eventcategory_name:</label>
    <input type="text" id="en" name="en"><br><br>

    <label for="ed">eventcategory_description:</label>
    <input type="text" id="ed" name="ed" required><br><br>

    <input type="submit" name="add" value="Insert">
  </form>

  <?php
  include('database_connection.php');

  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO eventcategories(eventcategory_id, eventcategory_name, eventcategory_description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $cid, $en, $ed);
    // Set parameters and execute
    $cid = $_POST['cid'];
    $en = $_POST['en'];
    $ed = $_POST['ed'];

    if ($stmt->execute() == TRUE) {
      echo "New record has been added successfully";
    } else {
      echo "Error: " . $stmt->error;
    }
    $stmt->close();
  }
  $connection->close();
  ?>

  <?php
  include('database_connection.php');

  // SQL query to fetch data from the eventcategories table
  $sql = "SELECT * FROM eventcategories";
  $result = $connection->query($sql);

  ?>
  <h2>Table of eventcategories</h2>
  <table border="5">
    <tr>
      <th>eventcategory_id</th>
      <th>eventcategory_name</th>
      <th>eventcategory_description</th>
      <th>Delete</th>
            <th>Update</th>
    </tr>
    <?php
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO eventcategories(eventcategory_name, eventcategory_description) VALUES (?, ?)");
    $stmt->bind_param("ss", $en, $ed);
    
    // Set parameters and execute
    $en = $_POST['en'];
    $ed = $_POST['ed'];

    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        // Check if the error is due to a duplicate entry
        if ($stmt->errno == 1062) {
            echo "Error: Duplicate entry. This event category already exists.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
}
$connection->close();
?>

  </table>
</section>
<footer>
  <center>
    <marquee behavior='alternate'>
      <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Aliane UMUTONIWASE</h2></b>
    </marquee>
  </center>
</footer>
</body>
</html>

