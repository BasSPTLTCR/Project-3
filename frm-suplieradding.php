<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>toevoegen Leverancier</title>
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
            $fullQuery = $db->prepare("SELECT `name` AS CountryName FROM `country` ORDER BY `CountryName` ASC");

        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        #3 querydoen
        $fullQuery->execute();

        #4 checkresult
        if ($fullQuery->RowCount() > 0)
        {
        $result=$fullQuery->FetchAll(PDO::FETCH_ASSOC);
?>
    <h2>Geef de gegevens van de Leverancier op</h2>
    <form action="./chk-suplieradding.php" method="post">
        <label for="supname">Leverancier Naam</label>
        <input type="text" name="supname" required>
        <label for="supname">Leverancier Aderes</label>
        <input type="text" name="supaddress" required>
        <label for="supname">Leverancier Land</label>
        <select name="supcountry">
        <?php
            foreach($result as $rij) 
            {
                echo "<option>".$rij["CountryName"]."</option>";
            }
        ?>
        </select>
        <label for="supname">Leverancier Telefoon</label>
        <input type="text" name="supPhonenr" required>
        <label for="supname">Leverancier E-mail</label>
        <input type="email" name="supEmail" required>
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