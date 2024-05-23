<?php
include('database_connection.php');

// Check if Account_Id is set
if(isset($_REQUEST['organizer_id'])) {
    $oid = $_REQUEST['organizer_id'];
    
    $stmt = $connection->prepare("SELECT * FROM organizer WHERE organizer_id=?");
    $stmt->bind_param("i", $oid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['organizer_id'];
        $u = $row['id'];
        $y = $row['organization_name'];
        $z = $row['contact_email'];
        
    } else {
        echo "organizer not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update new record in organizer</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update organizer form -->
    <h2><u>Update Form of organizer</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">user_id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="oname">organization_name:</label>
        <input type="text" name="oname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="ceml">contact_email:</label>
        <input type="text" name="ceml" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['uid'];
    $organization_name = $_POST['oname'];
    $contact_email = $_POST['ceml'];

    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE organizer SET id=?, organization_name=?, contact_email=? WHERE organizer_id=?");
    $stmt->bind_param("issi", $id, $organization_name, $contact_email, $oid);
    $stmt->execute();
    
    // Redirect to organizer.php
    header('Location: organizer.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
