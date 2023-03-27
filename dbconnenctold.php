<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=sira", "root", "");
}
catch(PDOExeption $e) {
    die("Fout bij verbinden met database: " . $e->getMessage());
}
?>