<?php
include('database_connection.php');

// Check if eventsessions is set
if(isset($_REQUEST['session_id'])) {
    $sid = $_REQUEST['session_id'];
    
    $stmt = $connection->prepare("SELECT * FROM eventsessions WHERE session_id=?");
    $stmt->bind_param("i", $sid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['session_id'];
        $u = $row['event_id'];
        $y = $row['session_title'];
        
    } else {
        echo "eventsessions not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in eventsessions</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update eventsessions form -->
    <h2><u>Update Form of eventsessions</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="eid">event_id:</label>
        <input type="number" name="eid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="stt">session_title:</label>
        <input type="text" name="stt" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

       

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve eventsessions values from form
    $event_id = $_POST['eid'];
    $session_title = $_POST['stt'];
    
    
    // Update the eventsessions in the database
    $stmt = $connection->prepare("UPDATE eventsessions SET event_id=?, session_title=? WHERE session_id=?");
    $stmt->bind_param("isi", $event_id, $session_title, $sid);
    $stmt->execute();
    
    // Redirect to eventsessions.php
    header('Location: eventsessions.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
