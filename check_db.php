<?php
include 'connect.php';

// Check if table exists
$tableCheck = "SHOW TABLES LIKE 'users'";
$result = $conn->query($tableCheck);

if ($result->num_rows == 0) {
    // Table doesn't exist, create it
    $createTable = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fName VARCHAR(50) NOT NULL,
        lName VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    if ($conn->query($createTable) === TRUE) {
        echo "Table 'users' created successfully<br>";
    } else {
        echo "Error creating table: " . $conn->error . "<br>";
    }
} else {
    // Table exists, drop it and create a new one with correct structure
    $dropTable = "DROP TABLE IF EXISTS users";
    if ($conn->query($dropTable) === TRUE) {
        echo "Old table dropped successfully<br>";
        
        // Create new table with correct structure
        $createTable = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            fName VARCHAR(50) NOT NULL,
            lName VARCHAR(50) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
        if ($conn->query($createTable) === TRUE) {
            echo "New table created with correct structure<br>";
        } else {
            echo "Error creating new table: " . $conn->error . "<br>";
        }
    } else {
        echo "Error dropping table: " . $conn->error . "<br>";
    }
}

// Show current table structure
$showStructure = "DESCRIBE users";
$result = $conn->query($showStructure);

echo "<br>Current table structure:<br>";
echo "<table border='1'>";
echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['Field'] . "</td>";
    echo "<td>" . $row['Type'] . "</td>";
    echo "<td>" . $row['Null'] . "</td>";
    echo "<td>" . $row['Key'] . "</td>";
    echo "<td>" . $row['Default'] . "</td>";
    echo "<td>" . $row['Extra'] . "</td>";
    echo "</tr>";
}
echo "</table>";

$conn->close();
?> 