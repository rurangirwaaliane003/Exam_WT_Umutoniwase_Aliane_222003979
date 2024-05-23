<?php
include('database_connection.php');

// Check if attendee_id is set
if(isset($_REQUEST['attendee_id'])) {
    $aid = $_REQUEST['attendee_id'];
    
    $stmt = $connection->prepare("SELECT * FROM attendees WHERE attendee_id=?");
    $stmt->bind_param("i", $aid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['attendee_id'];
        $u = $row['id'];
        $y = $row['event_id'];
    } else {
        echo "attendees not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in attendees</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update attendees form -->
    <h2><u>Update Form of attendees</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="eid">event_id:</label>
        <input type="text" name="uid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        
        

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $attendee_id = $_POST['aid'];
    $id = $_POST['uid'];
    $event_id = $_POST['eid'];
    
    
    // Update the attendees in the database
    $stmt = $connection->prepare("UPDATE attendees SET id=?, event_id=? WHERE attendee_id=?");
    $stmt->bind_param("iii", $attendee_id, $id, $event_id);
    $stmt->execute();
    
    // Redirect to attendees.php
    header('Location: attendees.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
