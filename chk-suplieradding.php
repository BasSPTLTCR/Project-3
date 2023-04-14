<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>verificatie Leverancier</title>
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
        #1-1 komt supname voor?
        try
        {
            $chksupname = $db->prepare("SELECT `name` FROM `supplier` WHERE `name` = :supname");
            $chksupname->bindValue(':supname', $supname);
            $chksupname->execute();
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chksupname->RowCount() > 0) {
            echo "Leveranciernaam bestaal al";
            header("Refresh:3; url=frm-suplieradding.php");
            die;
        }
        try
        {
            $chksupEmail = $db->prepare("SELECT `email` FROM `supplier` WHERE `email` = :supEmail");
            $chksupEmail->bindValue(':supEmail', $supEmail);
            $chksupEmail->execute();
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chksupEmail->RowCount()> 0) {
            echo "Leverancieremail bestaal al";
            header("Refresh:3; url=frm-suplieradding.php");
            die;
        }
        try
        {
            $chkPhonenr = $db->prepare("SELECT `phonenumber` FROM `supplier` WHERE `phonenumber` = :supPhonenr");
            $chkPhonenr->bindValue(':supPhonenr', $supPhonenr);
            $chkPhonenr->execute();
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkPhonenr->RowCount() > 0) {
            echo "LeveranciereTelefoon Nummer al ingebruik";
            header("Refresh:3; url=frm-suplieradding.php");
            die;
        }
        #2 querydef
        ?>
        <form action="./do-suplieradding.php" method="post">
        <input type="text" name="supname" value="<?php echo $supname ?>" readonly>
        <input type="text" name="supaddress" value="<?php echo $supaddress ?>" >
        <input type="text" name="supcountry" value="<?php echo $supcountry ?>" >
        <input type="text" name="supPhonenr" value="<?php echo $supPhonenr ?>" >
        <input type="email" name="supEmail" value="<?php echo $supEmail ?>" >
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