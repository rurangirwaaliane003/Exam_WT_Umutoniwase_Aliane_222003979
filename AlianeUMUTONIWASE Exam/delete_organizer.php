<?php
include('database_connection.php');

// Check if organization_id is set
if(isset($_REQUEST['organizer_id'])) {
    $oid = $_REQUEST['organizer_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM organizer WHERE organizer_id=?");
    $stmt->bind_param("i", $oid);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="oid" value="<?php echo $oid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($stmt->execute()) {
        echo "Record deleted successfully.
        <a href='organizer.php'>Yes</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "organizer_id is not set.";
}

$connection->close();
?>
