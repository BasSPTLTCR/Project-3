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
    if (! isset($_POST["prodname"]) || ! isset($_POST["prodprice"]) || ! isset($_POST["prodcategorie"]) || ! isset($_POST["prodleverancier"])) {
        echo "<h2>gegevens verloren, contact beheer</h2>";
        header("Refresh:3; url=frm-productadding.php");
        die;
    }
    require './dbconnenct.php';
    $productcategoriename = $_POST["prodcategorie"];
    try
        {
            $productpcategory = $db->prepare("SELECT id AS category_id FROM category WHERE name = :prodcategoriename");
            //  
            $productpcategory->bindValue(':productcategoriename', $productcategoriename);
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
                #3 querydoen
        $productpcategory->execute();

        #4 checkresult
        if ($productpcategory->RowCount() > 0)
        {
        $result=$productpcategoryid->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $rij) 
                    {
                        $productcategoryid = $rij["category_id"];
                    }
        }
    #maak hieronder de insert qry
    $productname = $_POST["productname"];
    $productprice = $_POST["productprice"];
    $productsupplierid = $_POST["productsupplierid"];
    echo $productname;
    echo $productprice;
    echo $productsupplierid;
    $insquery = $db->prepare("INSERT INTO product (id, name, price, supplier_id, category_id) VALUES (NULL, :productname, :productprice, :productsupplierid, :productcategorieid)"); 
    $insquery->bindValue("productname", $productname);
    $insquery->bindValue("productaddress", $productprice);
    $insquery->bindValue("productsupplierid", $productsupplierid);
    $insquery->bindValue("productcategorieid", $productcategorieid);
            $insquery   ->execute();
    ?>
    <?php
    include "./footer.php";
    ?>
</body>
</html>