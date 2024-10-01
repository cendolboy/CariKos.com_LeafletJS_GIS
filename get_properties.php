<?php
include 'config.php';

$sql = "SELECT * FROM kos";
$result = $conn->query($sql);

$properties = [];

if ($result->num_rows > 0) {
    // Ambil semua data ke dalam array
    while($row = $result->fetch_assoc()) {
        $properties[] = $row;
    }
}

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($properties);

$conn->close();
?>
