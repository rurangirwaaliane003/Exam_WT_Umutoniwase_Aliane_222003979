<?php
include('database_connection.php');

// Check if registration_id is set
if(isset($_REQUEST['registration_id'])) {
    $rid = $_REQUEST['registration_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM eventregistrations WHERE registration_id=?");
    $stmt->bind_param("i", $rid);
    
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
            <input type="hidden" name="rid" value="<?php echo $rid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        // Process form submission
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
    echo "registration_id is not set.";
}

$connection->close();
?>
