<?php
include('database_connection.php');

// Check if networking_opportunity_id is set
if(isset($_REQUEST['networking_opportunity_id'])) {
    $nid = $_REQUEST['networking_opportunity_id'];
    
    $stmt = $connection->prepare("SELECT * FROM networking_opportunities WHERE networking_opportunity_id=?");
    $stmt->bind_param("i", $nid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['networking_opportunity_id'];
        $u = $row['event_id'];
        $y = $row['title'];
    } else {
        echo "networking_opportunities not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in networking_opportunities</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update networking_opportunities form -->
    <h2><u>Update Form of networking_opportunities</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="eid">event_id:</label>
        <input type="number" name="eid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="tt">title:</label>
        <input type="text" name="tt" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $event_id = $_POST['eid'];
    $title = $_POST['tt'];
    
    
    // Update the networking_opportunities in the database
    $stmt = $connection->prepare("UPDATE networking_opportunities SET event_id=?, title=? WHERE networking_opportunity_id=?");
    $stmt->bind_param("ssd", $event_id, $title, $nid);
    $stmt->execute();
    
    // Redirect to networking_opportunities.php
    header('Location: networking_opportunities.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
