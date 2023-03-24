<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verificatie brouwer</title>
</head>
<body>
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
        header("Refresh:3; url=frm-insertbrewer.php");
    }
    else {
        require './connectbieren.php';
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
            $chkbrewname = $db->prepare("SELECT `name` FROM `supplier` WHERE `name` = :supname");
            $chkbrewname->bindValue(':supname', $supname);
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkbrewname->RowCount() < 0) {
            echo "Leveranciernaam bestaal al";
        }
        try
        {
            $chkbrewname = $db->prepare("SELECT `email` FROM `supplier` WHERE `email` = :supEmail");
            $chkbrewname->bindValue(':supEmail', $supEmail);
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkbrewname->RowCount() < 0) {
            echo "Leverancieremail bestaal al";
        }
        try
        {
            $chkbrewname = $db->prepare("SELECT `phonenumber` FROM `supplier` WHERE `phonenumber` = :supPhonenr");
            $chkbrewname->bindValue(':supPhonenr', $supPhonenr);
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkbrewname->RowCount() < 0) {
            echo "LeveranciereTelefoon Nummer al ingebruik";
        }
        #2 querydef
        ?>
        <form action="./frm-insertbrewer-read.php" method="post">
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
</body>
</html>