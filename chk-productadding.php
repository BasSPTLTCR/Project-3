<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>verificatie Product</title>
</head>
<body>
<?php
    include "./nav.php";
    ?>
    <?php
    

    function test_input($datatest) {
        $datatest = ltrim($datatest);
        $datatest = rtrim($datatest);
        $datatest = stripslashes($datatest);
        $datatest = htmlspecialchars($datatest);
        return $datatest;
    }
    #0a komt via frm?
    if (! isset($_POST["voegtoe"])) {
        echo "<h2>niet juiste mannier</h2>";
        header("Refresh:3; url=frm-productadding.php");
    }
    else {
        require './dbconnenct.php';
        $prodname = test_input($_POST["prodname"]);
        $prodprice = test_input($_POST["prodprice"]);
        $prodcategorie = test_input($_POST["prodcategorie"]);
        $prodleverancier = test_input($_POST["prodleverancier"]);

        #0b vraag gegeven voor voegtoe

        #1 control gegevens
        #1-1 komt id voor?
        try
        {
            $chkprodname = $db->prepare("SELECT `name` FROM `product` WHERE `name` = :prodname");
            $chkprodname->bindValue(':prodname', $prodname);
            $chkprodname->execute();
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkprodname->RowCount() > 0) {
            echo "Productnaam bestaal al";
            header("Refresh:3; url=frm-productadding.php");
            die;
        }
        try
        {
            $chkprice = $db->prepare("SELECT `price` FROM `product` WHERE `price` = :supprice");
            $chkprice->bindValue(':prodprice', $prodprice);
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkprice->RowCount() < 0) {
            echo "LeveranciereTelefoon Nummer al ingebruik";
        }
        #2 querydef
        ?>
        <form action="./do-productadding.php" method="post">
        <input type="text" name="prodname" value="<?php echo $prodname ?>" readonly>
        <input type="text" name="prodprice" value="<?php echo $prodprice ?>" >
        <input type="text" name="prodcategorie" value="<?php echo $prodcategorie ?>" >
        <input type="text" name="prodleverancier" value="<?php echo $prodleverancier ?>" >
        <input type="submit" value="annul" name="annul">
        <input type="submit" value="confirm" name="confirm">
    </form>
    <?php
    }
    ?>
    <?php
    include "./footer.php";
    ?>
</body>
</html>