<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Leverancier toevoegen</title>
</head>
<body>
<?php
    include "./nav.php";
    ?>
<?php
    if (isset($_POST["annul"])) {
        echo "<h2>Niet toevoegen</h2>";
        header("Refresh:3; url=frm-suplieradding.php");
        die;
    }
    if (!isset($_POST["confirm"])) {
        echo "<h2>Niet juist hier gekomen</h2>";
        header("Refresh:3; url=frm-suplieradding.php");
        die;
    }
    if (! isset($_POST["supname"]) || ! isset($_POST["supaddress"]) || ! isset($_POST["supcountry"]) || ! isset($_POST["supPhonenr"]) || ! isset($_POST["supEmail"]) ) {
        echo "<h2>gegevens verloren, contat beheer</h2>";
        header("Refresh:3; url=frm-suplieradding.php");
        die;
    }
    require './dbconnenct.php';
    $supcountryname = $_POST["supcountry"];
    try
        {
            $suppcountry = $db->prepare("SELECT `idcountry` FROM `country` WHERE `name` = :supcountryname");
            $suppcountry->bindValue(':supcountryname', $supcountryname);
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
                #3 querydoen
        $suppcountry->execute();

        #4 checkresult
        if ($suppcountry->RowCount() > 0)
        {
        $result=$suppcountry->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $rij) 
                    {
                        $supcountryid = $rij["idcountry"];
                    }
        }
        echo $supcountryid;
    #maak hieronder de insert qry
    $supname = isset($_POST["supname"]);
    $supaddress = isset($_POST["supaddress"]);
    $supPhonenr = isset($_POST["supPhonenr"]);
    $supEmail = isset($_POST["supEmail"]);
    $insquery = $db->prepare("INSERT INTO supplier (id, name, address, country_id, phonenumber, email) VALUES (NULL, :supname, :supaddress, :supcountryid, :supPhonenr, :supEmail)"); 
    $insquery->bindValue("supname", $supname);
    $insquery->bindValue("supaddress", $supaddress);
    $insquery->bindValue("supPhonenr", $supPhonenr);
    $insquery->bindValue("supcountryid", $supcountryid);
    $insquery->bindValue("supEmail", $supEmail);
            $insquery   ->execute();
    ?>
    <?php
    include "./footer.php";
    ?>
</body>
</html>