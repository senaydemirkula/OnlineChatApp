<?php
// Create database and tables
try {
    $pdo = new PDO('mysql:host=localhost;port=3306', 'admin', 'admin');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create database
    $pdo->exec("CREATE DATABASE IF NOT EXISTS onlinechatapp");
    $pdo->exec("USE onlinechatapp");

    // Create message table
    $pdo->exec("CREATE TABLE IF NOT EXISTS message (
        id INT AUTO_INCREMENT PRIMARY KEY,
        content TEXT,
        user_id INT,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES user(user_id)
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS user (
        user_id INT AUTO_INCREMENT PRIMARY KEY
    )");

    echo "Database and tables created successfully.<br>";

} catch(PDOException $e) {
    die("Error creating database: " . $e->getMessage());
}

$sourceDir = "/path/to/your/application"; 
$destinationDir = dirname(__FILE__); 
$files = array_diff(scandir($sourceDir), array('.', '..'));

foreach ($files as $file) {
    $sourceFile = $sourceDir . '/' . $file;
    $destinationFile = $destinationDir . '/' . $file;
    if (is_file($sourceFile)) {
        if (!copy($sourceFile, $destinationFile)) {
            echo "Failed to copy $file...<br>";
        }
    }
}

echo "Application files transferred successfully.<br>";
?>
