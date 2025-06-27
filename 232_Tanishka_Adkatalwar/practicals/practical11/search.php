<?php
// Sample student records (You can replace this with DB later)
$students = ["Rushikesh Shrimanwar", "Mahesh Giri", "Amit Saha", "narendra modi", "Elon musk",];

$q = strtolower(trim($_GET['q'] ?? ''));

if ($q === '') {
    echo "No input.";
    exit;
}

$matches = array_filter($students, fn($name) => stripos($name, $q) !== false);

if (count($matches) === 0) {
    echo "No student found.";
} else {
    echo "<ul>";
    foreach ($matches as $student) {
        echo "<li>" . htmlspecialchars($student) . "</li>";
    }
    echo "</ul>";
}
