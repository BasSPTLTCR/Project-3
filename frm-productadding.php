<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>toevoegen Product</title>
</head>
<body>
<?php
    include "./nav.php";
    ?>
    <?php
        #1 verbinding database
        require './dbconnenct.php';

        #2 querydef
        try
        {
            $fullQuery = $db->prepare("SELECT `name` AS catname FROM `category` ORDER BY `name` ASC;");
            $oneQuery = $db->prepare("SELECT `name` AS supname FROM `supplier` ORDER BY `name` ASC");

        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        #3 querydoen
        $fullQuery->execute();
        $oneQuery->execute();

        #4 checkresult
        if ($fullQuery->RowCount() > 0 && $oneQuery->RowCount() > 0 )
        {
        $result=$fullQuery->FetchAll(PDO::FETCH_ASSOC);
?>
    <h2>Geef de gegevens van het product op</h2>
    <form action="./chk-productadding.php" method="post">
        <label for="prodname">Product naam</label>
        <input type="text" name="prodname" required>
        <label for="prodname">Product prijs</label>
        <input type="text" name="prodaddress" required>
        <label for="prodname">Product category</label>
        <select name="prodcategorie">
        <?php
            foreach($result as $rij) 
            {
                echo "<option>".$rij["catname"]."</option>";
            }
        ?>
        </select>
        <label for="prodleverancier">Leverancier</label>
        <select name="prodleverancier">
        <?php
            foreach($result as $rij) 
            {
                echo "<option>".$rij["supname"]."</option>";
            }
        ?>
        </select>
        <input type="submit" value="voegtoe" name="voegtoe">
    </form>
    <?php
        }
    ?>
    <?php
    include "./footer.php";
    ?>
</body>
</html>