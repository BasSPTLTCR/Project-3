<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>verificatie categorie</title>
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
        header("Refresh:3; url=frm-categoryadding.php");
    }
    else {
        require './dbconnenct.php';
        $catname = test_input($_POST["catname"]);

        #0b vraag gegeven voor voegtoe

        #1 control gegevens
        #1-1 komt id voor?
        try
        {
            $chkcatname = $db->prepare("SELECT `name` FROM `category` WHERE `name` = :catname");
            $chkcatname->bindValue(':catname', $catname);
            $chkcatname->execute(); 
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkcatname->Rowcount() > 0) {
            echo "Categorie bestaal al";
            header("Refresh:3; url=frm-categoryadding.php");
            exit();
        }
        #2 querydef
        ?>
        <form action="./do-categoryadding.php" method="post">
        <input type="text" name="catname" value="<?php echo $catname ?>" readonly>
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