<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Product toevoegen</title>
</head>
<body>
<?php
    include "./nav.php";
    ?>
<?php
    if (isset($_POST["annul"])) {
        echo "<h2>Niet toevoegen</h2>";
        header("Refresh:3; url=frm-productadding.php");
        die;
    }
    if (!isset($_POST["confirm"])) {
        echo "<h2>Niet juist hier gekomen</h2>";
        header("Refresh:3; url=frm-productadding.php");
        die;
    }
    if (! isset($_POST["productname"]) || ! isset($_POST["productaddress"]) || ! isset($_POST["productcountry"]) || ! isset($_POST["productPhonenr"]) || ! isset($_POST["productEmail"]) ) {
        echo "<h2>gegevens verloren, contat beheer</h2>";
        header("Refresh:3; url=frm-productadding.php");
        die;
    }
    require './dbconnenct.php';
    $productcountryname = $_POST["productcountry"];
    try
        {
            $productpcountry = $db->prepare("SELECT `idcountry` FROM `country` WHERE `name` = :productcountryname");
            $productpcountry->bindValue(':productcountryname', $productcountryname);
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
                #3 querydoen
        $productpcountry->execute();

        #4 checkresult
        if ($productpcountry->RowCount() > 0)
        {
        $result=$productpcountry->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $rij) 
                    {
                        $productcountryid = $rij["idcountry"];
                    }
        }
    #maak hieronder de insert qry
    $productname = $_POST["productname"];
    $productaddress = $_POST["productaddress"];
    $productPhonenr = $_POST["productPhonenr"];
    $productEmail = $_POST["productEmail"];
    echo $productname;
    echo $productaddress;
    echo $productPhonenr;
    echo $productEmail;
    $insquery = $db->prepare("INSERT INTO product (id, name, address, country_id, phonenumber, email) VALUES (NULL, :productname, :productaddress, :productcountryid, :productPhonenr, :productEmail)"); 
    $insquery->bindValue("productname", $productname);
    $insquery->bindValue("productaddress", $productaddress);
    $insquery->bindValue("productPhonenr", $productPhonenr);
    $insquery->bindValue("productcountryid", $productcountryid);
    $insquery->bindValue("productEmail", $productEmail);
            $insquery   ->execute();
    ?>
    <?php
    include "./footer.php";
    ?>
</body>
</html>