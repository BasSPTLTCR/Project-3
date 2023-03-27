<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=siratest", "root", "");
}
catch(PDOExeption $e) {
    die("Fout bij verbinden met database: " . $e->getMessage());
}
?>