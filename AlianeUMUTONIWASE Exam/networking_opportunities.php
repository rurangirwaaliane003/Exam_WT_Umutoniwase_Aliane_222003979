<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>networking_opportunities</title>
  <style>
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
    header{
    background-color:skyblue;
}
    section{
    padding:71px;
    border-bottom: 1px solid #ddd;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:skyblue;
    }

  </style>

  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  </head>

  <header>

<body bgcolor="chocolate">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./images/logo.jpg" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Service.html">SERVICE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./organizer.php">ORGANIZER</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./events.php">EVENTS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./eventsessions.php">EVENTSESSIONS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./eventregistrations.php">EVENTREGISTRATIONS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./eventcategories.php">EVENTCATEGORIES</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./attendees.php">ATTENDEES</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">FEEDBACK</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./networking_opportunities.php">NETWORKINGOPPORTUNITIES</a>
  </li>
   </li>
  <li style="display: inline; margin-right: 10px;"><a href="./profiles.php">PROFILES</a>
  </li>
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>

    <h1><u> networking_opportunities Form </u></h1>
    <form method="post" onsubmit="return confirmInsert();">
            
        <label for="nid">networking_opportunity_id:</label>
        <input type="number" id="nid" name="nid"><br><br>

        <label for="eid">event_id:</label>
        <input type="number" id="eid" name="eid"><br><br>

        <label for="tt">title:</label>
        <input type="text" id="tt" name="tt" required><br><br>

       

        <input type="submit" name="add" value="Insert">
      

    </form>


<?php
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO networking_opportunities(networking_opportunity_id, event_id, title) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nid, $eid, $tt);
    // Set parameters and execute
    $nid = $_POST['nid'];
    $eid = $_POST['eid'];
    $tt = $_POST['tt'];
    
   
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

// SQL query to fetch data from the networking_opportunities table
$sql = "SELECT * FROM networking_opportunities";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of networking_opportunities</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of networking_opportunities</h2></center>
    <table border="5">
        <tr>
            <th>networking_opportunity_id</th>
            <th>event_id</th>
            <th>title</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
      include('database_connection.php');

        // Prepare SQL query to retrieve all networking_opportunities
        $sql = "SELECT * FROM networking_opportunities";
        $result = $connection->query($sql);

        // Check if there are any networking_opportunities
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $nid = $row['networking_opportunity_id']; // Fetch the networking_opportunity_id
                echo "<tr>
                    <td>" . $row['networking_opportunity_id'] . "</td>
                    <td>" . $row['event_id'] . "</td>
                    <td>" . $row['title'] . "</td>
                    <td><a style='padding:4px' href='delete_networking_opportunities.php?networking_opportunity_id=$nid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_networking_opportunities.php?networking_opportunity_id=$nid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

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