<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>verificatie country</title>
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
        header("Refresh:3; url=frm-countryadding.php");
    }
    else {
        require './dbconnenct.php';
        $countname = test_input($_POST["countname"]);
        $countcode = test_input($_POST["countcode"]);

        #0b vraag gegeven voor voegtoe

        #1 control gegevens
        #1-1 komt id voor?
        try
        {
            $chkcountname = $db->prepare("SELECT `name` FROM `country` WHERE `name` = :countname");
            $chkcountname->bindValue(':countname', $countname);
            $chkcountname->execute(); 
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkcountname->RowCount() > 0) {
            echo "Land bestaal al";
            header("Refresh:3; url=frm-countryadding.php");
            exit();
        }
        try
        {
            $chkcountcode = $db->prepare("SELECT `code` FROM `country` WHERE `code` = :countcode");
            $chkcountcode->bindValue(':countcode', $countcode);
            $chkcountcode->execute(); 
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkcountcode->RowCount() > 0) {
            echo "code bestaal al";
            header("Refresh:3; url=frm-countryadding.php");
            exit();
        }
        
        
        #2 querydef
        ?>
        <form action="./do-countryadding.php" method="post">
        <input type="text" name="countname" value="<?php echo $countname ?>" readonly>
        <input type="text" name="countcode" value="<?php echo $countcode ?>" readonly>
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