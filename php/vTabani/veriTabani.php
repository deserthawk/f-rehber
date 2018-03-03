<?php

function connectionVT()
{
    $servername = "localhost";
    $username = "root";
    $password = "1234qqqQ";
    
    try {
        $pdo = new PDO("mysql:host=$servername;port=3306;dbname=test_fotograf", $username, $password);
        $pdo->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("ERROR: Could not connect. " . $e->getMessage());
    }
}
?>