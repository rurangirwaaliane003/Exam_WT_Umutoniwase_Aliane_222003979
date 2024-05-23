<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
include('database_connection.php');


    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'attendees' => "SELECT event_id FROM attendees WHERE event_id LIKE '%$searchTerm%'",
        'eventcategories' => "SELECT eventcategory_name FROM eventcategories WHERE eventcategory_name LIKE '%$searchTerm%'",
        'eventregistrations' => "SELECT event_id FROM eventregistrations WHERE event_id LIKE '%$searchTerm%'",
        'events' => "SELECT event_name FROM events WHERE event_name LIKE '%$searchTerm%'",
        'eventsessions' => "SELECT session_title FROM eventsessions WHERE session_title LIKE '%$searchTerm%'",
        'feedback' => "SELECT event_id FROM feedback WHERE event_id LIKE '%$searchTerm%'",
        'networking_opportunities' => "SELECT title FROM networking_opportunities WHERE title LIKE '%$searchTerm%'",
        'organizer' => "SELECT organization_name FROM organizer WHERE organization_name LIKE '%$searchTerm%'",
        'profiles' => "SELECT bio FROM profiles WHERE bio LIKE '%$searchTerm%'"

    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
