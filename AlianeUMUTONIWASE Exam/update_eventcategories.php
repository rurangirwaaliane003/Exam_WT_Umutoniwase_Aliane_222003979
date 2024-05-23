<?php
include('database_connection.php');

// Check if eventcategory_id is set
if(isset($_REQUEST['eventcategory_id'])) {
    $eid = $_REQUEST['eventcategory_id'];
    
    $stmt = $connection->prepare("SELECT * FROM eventcategories WHERE eventcategory_id=?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['eventcategory_id'];
        $u = $row['eventcategory_name'];
        $y = $row['eventcategory_description'];
    } else {
        echo "eventcategories not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in eventcategories</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update eventcategories form -->
    <h2><u>Update Form of eventcategories</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="en">eventcategory_name:</label>
        <input type="text" name="en" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="ec">eventcategory_description:</label>
        <input type="text" name="ed" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $eventcategory_name = $_POST['en'];
    $eventcategory_description = $_POST['ed'];
    
    
    // Update the eventcategories in the database
    $stmt = $connection->prepare("UPDATE eventcategories SET eventcategory_name=?, eventcategory_description=? WHERE eventcategory_id=?");
    $stmt->bind_param("ssd", $eventcategory_name, $eventcategory_description, $cid);
    $stmt->execute();
    
    // Redirect to eventcategories.php
    header('Location: eventcategories.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
