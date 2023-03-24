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
        $brewname = test_input($_POST["brewname"]);
        $brewcountry = test_input($_POST["brewcountry"]);

        #0b vraag gegeven voor voegtoe
        // // $brewid = filter_input(INPUT_POST, "brewid", FILTER_SANITIZE_NUMBER_INT);
        // $brewid = filter_input(INPUT_POST, "brewid", FILTER_SANITIZE_NUMBER_INT);
        // // $brewname = filter_input(INPUT_POST, "brewname", FILTER_SANITIZE_STRING);
        // $brewname = filter_input(INPUT_POST, "brewname", FILTER_SANITIZE_STRING);
        // // $brewcountry = filter_input(INPUT_POST, "brewcountry", FILTER_SANITIZE_STRING);
        // $brewcountry = filter_input(INPUT_POST, "brewcountry", FILTER_SANITIZE_STRING);

        #1 control gegevens
        #1-1 komt id voor?
        try
        {
            $chkbrewnr = $db->prepare("SELECT brouwcode FROM `brouwer` WHERE brouwcode = :brewid");
            $chkbrewnr->bindValue(':brewid', $brewid);

        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkbrewnr->RowCount() < 0) {
            echo "brouwcode bestaal al";
        }
        try
        {
            $chkbrewname = $db->prepare("SELECT brouwcode FROM `brouwer` WHERE brouwcode = :brewname");
            $chkbrewname->bindValue(':brewname', $brewname);
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkbrewname->RowCount() < 0) {
            echo "brouwcode bestaal al";
        }
        if (strlen($brewcountry) > 4) {
            echo "Te lang 4 = max";
        }
        #2 querydef
        ?>
        <form action="./frm-insertbrewer-read.php" method="post">
        <input type="number" name="brewid" value="<?php echo $brewid ?>" readonly>
        <input type="text" name="brewname" value="<?php echo $brewname ?>" readonly>
        <input type="text" name="brewcountry" value="<?php echo $brewcountry ?>" readonly>
        <input type="submit" value="annul" name="annul">
        <input type="submit" value="confirm" name="confirm">
    </form>
    <?php
    }
    ?>
</body>
</html>