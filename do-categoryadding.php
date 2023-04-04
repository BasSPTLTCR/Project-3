<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Categorie toevoegen</title>
</head>
<body>
<?php
    include "./nav.php";
    ?>
<?php
    if (isset($_POST["annul"])) {
        echo "<h2>Niet toevoegen</h2>";
        header("Refresh:3; url=frm-categoryadding.php");
        die;
    }
    if (!isset($_POST["confirm"])) {
        echo "<h2>Niet juist hier gekomen</h2>";
        header("Refresh:3; url=frm-categoryadding.php");
        die;
    }
    if (! isset($_POST["catname"])) {
        echo "<h2>gegevens verloren, contact beheer</h2>";
        header("Refresh:3; url=frm-categoryadding.php");
        die;
    }
    require './dbconnenct.php';
    $catname = $_POST["catname"];
    
    #maak hieronder de insert qry
    echo $catname;
    $insquery = $db->prepare("INSERT INTO category (`name`) VALUES (:catname)"); 
    $insquery->bindValue("catname", $catname);
            $insquery   ->execute();
    ?>
    <?php
    include "./footer.php";
    ?>
</body>
</html>