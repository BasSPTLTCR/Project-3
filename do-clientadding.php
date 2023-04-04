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
        header("Refresh:3; url=frm-clientadding.php");
        die;
    }
    if (!isset($_POST["confirm"])) {
        echo "<h2>Niet juist hier gekomen</h2>";
        header("Refresh:3; url=frm-clientadding.php");
        die;
    }
    if (!isset($_POST["clientfirstname"]) || !isset($_POST["clientsurname"]) || !isset($_POST["clientgender"]) || !isset($_POST["clientaddress"]) ||
        !isset($_POST["clientcity"]) || !isset($_POST["clientzipcode"]) || !isset($_POST["clientemail"]) || !isset($_POST["clientphonenumber"]) || 
        !isset($_POST["clientusername"]) || ! isset($_POST["clientpassword"])) {
        echo "<h2>gegevens verloren, contact beheer</h2>";
        header("Refresh:3; url=frm-clientadding.php");
        die;
    }
    require './dbconnenct.php';
    $productcategoriename = $_POST["prodcategorie"];
    try {
        $productpcategory = $db->prepare("SELECT id AS category_id FROM category WHERE name = :productcategoriename");
        $productpcategory->bindValue(':productcategoriename', $productcategoriename);
    } catch (PDOException $e) {
        die("Fout bij verbinden met database: " . $e->getMessage());
    }
    #3 querydoen
    $productpcategory->execute();

    #4 checkresult
    if ($productpcategory->RowCount() > 0) {
        $result = $productpcategory->FetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $rij) {
            $prodcategoryid = $rij["category_id"];
        }
    }
    $productsuppliername = $_POST["prodleverancier"];
    try {
        $productsupplier = $db->prepare("SELECT id AS supplier_id FROM supplier WHERE name = :productleveranciername");
        $productsupplier->bindValue(':productleveranciername', $productsuppliername);
    } catch (PDOException $e) {
        die("Fout bij verbinden met database: " . $e->getMessage());
    }
    #3 querydoen
    $productsupplier->execute();

    #4 checkresult
    if ($productsupplier->RowCount() > 0) {
        $result = $productsupplier->FetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $rij) {
            $prodsupplierid = $rij["supplier_id"];
        }
    }
    #maak hieronder de insert qry
    $productname = $_POST["prodname"];
    $productprice = $_POST["prodprice"];
    echo $productname;
    echo $productprice;
    $insquery = $db->prepare("INSERT INTO product (id, name, price, supplier_id, category_id) VALUES (NULL, :prodname, :prodprice, :prodsupplierid, :prodcategorieid)");
    $insquery->bindValue("prodname", $productname);
    $insquery->bindValue("prodprice", $productprice);
    $insquery->bindValue("prodsupplierid", $prodsupplierid);
    $insquery->bindValue("prodcategorieid", $prodcategoryid);
    $insquery->execute();
    ?>
    <?php
    include "./footer.php";
    ?>
</body>

</html>