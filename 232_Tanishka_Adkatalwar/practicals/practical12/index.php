<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Get sort order from URL (default is ascending)
$order = isset($_GET['order']) && strtolower($_GET['order']) === 'desc' ? 'DESC' : 'ASC';

// Fetch and sort students
$sql = "SELECT * FROM students ORDER BY name $order";
$result = $conn->query($sql);

// Show dropdown and table
echo "<h2>Student List (Sorted: $order)</h2>";
echo "<a href='?order=asc'>Sort Ascending</a> | <a href='?order=desc'>Sort Descending</a>";

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['name']) . "</li>";
    }
    echo "</ul>";
} else {
    echo "No students found.";
}

$conn->close();