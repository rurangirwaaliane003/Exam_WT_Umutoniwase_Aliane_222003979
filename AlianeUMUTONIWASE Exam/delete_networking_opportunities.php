<?php
include('database_connection.php');

// Check if networking_opportunity_id is set
if(isset($_REQUEST['networking_opportunity_id'])) {
    $nid = $_REQUEST['networking_opportunity_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM networking_opportunities WHERE networking_opportunity_id=?");
    $stmt->bind_param("i", $nid);
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
            <input type="hidden" name="nid" value="<?php echo $nid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
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
    echo "networking_opportunity_id is not set.";
}

$connection->close();
?>
