<?php
include('database_connection.php');

// Check if profile_id is set
if(isset($_REQUEST['profile_id'])) {
    $pid = $_REQUEST['profile_id'];
    
    $stmt = $connection->prepare("SELECT * FROM profiles WHERE profile_id=?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['profile_id'];
        $u = $row['id'];
        $y = $row['bio'];
    } else {
        echo "profiles not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in profiles</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update profiles form -->
    <h2><u>Update Form of profiles</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="bo">bio:</label>
        <input type="text" name="bo" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['uid'];
    $bio = $_POST['bo'];
    
    
    // Update the profiles in the database
    $stmt = $connection->prepare("UPDATE profiles SET id=?, bio=? WHERE profile_id=?");
    $stmt->bind_param("isd", $id, $bio, $pid);
    $stmt->execute();
    
    // Redirect to profiles.php
    header('Location: profiles.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
