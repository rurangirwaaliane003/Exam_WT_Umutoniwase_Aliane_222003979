<?php
include('database_connection.php');

// Check if registration_id is set
if(isset($_REQUEST['registration_id'])) {
    $rid = $_REQUEST['registration_id'];
    
    $stmt = $connection->prepare("SELECT * FROM eventregistrations WHERE registration_id=?");
    $stmt->bind_param("i", $rid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['registration_id'];
        $u = $row['id'];
        $y = $row['event_id'];
    } else {
        echo "eventregistrations not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in eventregistrations</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update eventregistrations form -->
    <h2><u>Update Form of eventregistrations</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="eid">event_id:</label>
        <input type="text" name="eid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['uid'];
    $event_id = $_POST['eid'];
    
    
    // Update the eventregistrations in the database
    $stmt = $connection->prepare("UPDATE eventregistrations SET  id=?, event_id=? WHERE registration_id=?");
    $stmt->bind_param("iid", $id, $event_id, $rid);
    $stmt->execute();
    
    // Redirect to eventregistrations.php
    header('Location: eventregistrations.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
