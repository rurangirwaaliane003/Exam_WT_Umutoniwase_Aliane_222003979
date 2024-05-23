<?php
include('database_connection.php');

// Check if event_id is set
if(isset($_REQUEST['event_id'])) {
    $eid = $_REQUEST['event_id'];
    
    $stmt = $connection->prepare("SELECT * FROM events WHERE event_id=?");
    $stmt->bind_param("i", $eid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['event_id'];
        $u = $row['organizer_id'];
        $y = $row['event_name'];
    } else {
        echo "events not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in events</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update events form -->
    <h2><u>Update Form of events</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="oid">organizer_id:</label>
        <input type="text" name="oid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="ename">event_name:</label>
        <input type="text" name="ename" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $organizer_id = $_POST['oid'];
    $event_name = $_POST['ename'];
    
    
    // Update the events in the database
    $stmt = $connection->prepare("UPDATE events SET organizer_id=?, event_name=? WHERE event_id=?");
    $stmt->bind_param("ssd", $organizer_id, $event_name, $eid);
    $stmt->execute();
    
    // Redirect to events.php
    header('Location: events.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
