<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>land toevoegen</title>
</head>
<body>
<?php
    include "./nav.php";
    ?>
<?php
    if (isset($_POST["annul"])) {
        echo "<h2>Niet toevoegen</h2>";
        header("Refresh:3; url=frm-countryadding.php");
        die;
    }
    if (!isset($_POST["confirm"])) {
        echo "<h2>Niet juist hier gekomen</h2>";
        header("Refresh:3; url=frm-countryadding.php");
        die;
    }
    if (! isset($_POST["countname"]) || ! isset($_POST["countcode"]) ) {
        echo "<h2>gegevens verloren, contact beheer</h2>";
        header("Refresh:3; url=frm-countryadding.php");
        die;
    }
    require './dbconnenct.php';
    $countname = $_POST["countname"];
    $countcode = $_POST["countcode"];
    #maak hieronder de insert qry
    echo $countname;
    echo "<br>";
    echo $countcode;
    $insquery = $db->prepare("INSERT INTO country (`name`, code) VALUES (:countname, :countcode)"); 
    $insquery->bindValue("countname", $countname);
    $insquery->bindValue("countcode", $countcode);
            $insquery   ->execute();
    ?>
    <?php
    include "./footer.php";
    ?>
</body>
</html>