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
        header("Refresh:3; url=frm-suplieradding.php");
    }
    else {
        require './dbconnenct.php';
        $supname = test_input($_POST["supname"]);
        $supaddress = test_input($_POST["supaddress"]);
        $supcountry = test_input($_POST["supcountry"]);
        $supPhonenr = test_input($_POST["supPhonenr"]);
        $supEmail = test_input($_POST["supEmail"]);

        #0b vraag gegeven voor voegtoe

        #1 control gegevens
        #1-1 komt id voor?
        try
        {
            $chkprodname = $db->prepare("SELECT `name` FROM `product` WHERE `name` = :prodname");
            $chkprodname->bindValue(':prodname', $prodname);
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkprodname->RowCount() < 0) {
            echo "Leveranciernaam bestaal al";
        }
        try
        {
            $chkprodName = $db->prepare("SELECT `name` FROM `product` WHERE `name` = :prodname");
            $chkprodName->bindValue(':prodName', $prodName);
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkprodName->RowCount() < 0) {
            echo "Product naam bestaal al";
        }
        try
        {
            $chkPhonenr = $db->prepare("SELECT `phonenumber` FROM `product` WHERE `phonenumber` = :supPhonenr");
            $chkPhonenr->bindValue(':supPhonenr', $supPhonenr);
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkPhonenr->RowCount() < 0) {
            echo "LeveranciereTelefoon Nummer al ingebruik";
        }
        #2 querydef
        ?>
        <form action="./do-productadding.php" method="post">
        <input type="text" name="prodname" value="<?php echo $prodname ?>" readonly>
        <input type="text" name="prodaddress" value="<?php echo $prodaddress ?>" >
        <input type="text" name="prodcountry" value="<?php echo $prodcountry ?>" >
        <input type="text" name="prodPhonenr" value="<?php echo $prodPhonenr ?>" >
        <input type="email" name="prodEmail" value="<?php echo $prodEmail ?>" >
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