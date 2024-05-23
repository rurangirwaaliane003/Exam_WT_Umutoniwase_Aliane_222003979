<?php
include('database_connection.php');

// Check if feedback_id is set
if(isset($_REQUEST['feedback_id'])) {
    $fid = $_REQUEST['feedback_id'];
    
    $stmt = $connection->prepare("SELECT * FROM feedback WHERE feedback_id=?");
    $stmt->bind_param("i", $fid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['feedback_id'];
        $u = $row['id'];
        $y = $row['event_id'];
    } else {
        echo "feedback not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in feedback</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update feedback form -->
    <h2><u>Update Form of feedback</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="eid">event_id:</label>
        <input type="number" name="eid" value="<?php echo isset($y) ? $y : ''; ?>">
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
    
    
    // Update the feedback in the database
    $stmt = $connection->prepare("UPDATE feedback SET id=?, event_id=? WHERE feedback_id=?");
    $stmt->bind_param("ssd", $id, $event_id, $fid);
    $stmt->execute();
    
    // Redirect to feedback.php
    header('Location: feedback.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
