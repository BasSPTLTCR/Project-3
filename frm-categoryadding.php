<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Categorie toevoegen </title>
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
            $fullQuery = $db->prepare("SELECT category.`name` AS catname FROM `category` ORDER BY `name` ASC;");
            
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
    <h2>voeg een Categorie toe</h2>
    <form action="./chk-categoryadding.php" method="post">
        <label for="catname">Categorie</label>
        <input type="text" name="catname" required>
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