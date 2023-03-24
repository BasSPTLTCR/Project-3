<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
                        echo $supcountryid;
                    }
        }
    #maak hieronder de insert qry
    // $brewid = isset($_POST["brewid"]);
    // $brewname = isset($_POST["brewname"]);
    // $brewcountry = isset($_POST["brewcountry"]);
    // $insquery = $db->prepare("INSERT INTO brouwer (brouwcode, naam, land) 
    //             VALUES (:brewid,  :brewname, :brewcountry)"); 
    // $insquery->bindValue("brewid", $brewid);
    // $insquery->bindValue("brewname", $brewname);
    // $insquery->bindValue("brewcountry", $brewcountry);
    //         $insquery   ->execute();
    ?>
</body>
</html>